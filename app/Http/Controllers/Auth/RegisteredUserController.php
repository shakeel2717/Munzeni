<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create($refer = 'default'): View
    {
        return view('auth.register', compact('refer'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:18', 'unique:' . User::class],
            'refer' => ['nullable', 'string'],
        ]);

        $password = $request->password;
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);

        if (!$uppercase || !$lowercase || !$number || strlen($password) < 8 || strlen($password) > 15) {
            return back()->withErrors(['Password must be 8 to 15 characters and must contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character.']);
        }

        if ($request->refer != 'default') {
            $upliner = User::where('user_code', $request->refer)->firstOrFail();
            $upliner = $upliner->username;
        } else {
            $upliner = 'default';
        }

        generateCode:
        $code = "MZ" . rand(0000000, 99999999);
        // checking if this is not available
        $checkCode = User::where('user_code', $code)->count();
        if ($checkCode > 0) {
            goto generateCode;
        }


        $otp = generateRandomOTP(6);

        $phoneNumberUtil = PhoneNumberUtil::getInstance();
        // checking if phone number is contain + in starter
        if (!substr($request->phone, 0, 1) != '+') {
            $request->phone = '+' . $request->phone;
        }

        try {
            $phoneNumber = $phoneNumberUtil->parse($request->phone, null);
        } catch (\Throwable $th) {
            return back()->withErrors(['Invalid phone number, ' . $th->getMessage()]);
        }

        if (!$phoneNumberUtil->isValidNumber($phoneNumber)) {
            // Invalid phone number
            return back()->withErrors(['Invalid phone number, Please try again with a valid phone number with country code.']);
        }

        $formattedPhoneNumber = $phoneNumberUtil->format($phoneNumber, PhoneNumberFormat::E164);

        DB::transaction(function () use ($upliner, $request, $formattedPhoneNumber, $code, $otp) {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'refer' => $upliner ?? 'default',
                'otp' => $otp,
                'phone' => $formattedPhoneNumber,
                'user_code' => $code,
                'password' => Hash::make($request->password),
            ]);
    
    
            event(new Registered($user));
    
            Auth::login($user);
        });


        session(['hashed_password' => auth()->user()->password]);

        return redirect(RouteServiceProvider::HOME);
    }
}
