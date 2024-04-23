<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class AllUsers extends PowerGridComponent
{
    use WithExport;
    public $name;
    public $email;
    public $username;
    // public $authenticator_code;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return User::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('email')
            ->add('username')
            ->add('role')
            ->add('status')
            ->add('kyc_status')
            ->add('refer')
            ->add('user_code')
            ->add('authenticator')
            ->add('authenticator_code')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Name', 'name')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Username', 'username')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Role', 'role')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            // Column::make('Kyc status', 'kyc_status')
            //     ->sortable()
            //     ->searchable(),

            Column::make('Refer', 'refer')
                ->sortable()
                ->searchable(),

            Column::make('User code', 'user_code')
                ->sortable()
                ->searchable(),

            // Column::make('Authenticator', 'authenticator')
            //     ->sortable()
            //     ->searchable(),

            // Column::make('Authenticator code', 'authenticator_code')
            //     ->sortable()
            //     ->editOnClick()
            //     ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function onUpdatedEditable(string|int $id, string $field, string $value): void
    {
        User::query()->find($id)->update([
            $field => $value,
        ]);
    }

    public function filters(): array
    {
        return [
            Filter::inputText('name')->operators(['contains']),
            Filter::inputText('email')->operators(['contains']),
            Filter::inputText('username')->operators(['contains']),
            Filter::inputText('role')->operators(['contains']),
            Filter::inputText('status')->operators(['contains']),
            // Filter::inputText('kyc_status')->operators(['contains']),
            Filter::inputText('refer')->operators(['contains']),
            Filter::boolean('authenticator'),
            // Filter::inputText('authenticator_code')->operators(['contains']),
            Filter::datetimepicker('created_at'),
        ];
    }

    public function actions(User $row): array
    {
        return [
            Button::make('suspend', 'Suspend')
                ->class('btn btn-danger btn-sm')
                ->dispatch('suspend', ['id' => $row->id]),

            Button::make('activate', 'Activate')
                ->class('btn btn-danger btn-sm')
                ->dispatch('activate', ['id' => $row->id]),

            Button::make('login', 'LOGIN')
                ->class('btn btn-success btn-sm')
                ->dispatch('login', ['id' => $row->id]),
        ];
    }

    #[\Livewire\Attributes\On('suspend')]
    public function suspend($id)
    {
        $user = User::find($id);
        $user->status = 'suspend';
        $user->save();

        $this->dispatch('showAlert', ['message' => 'User Suspended Successfully']);
    }

    #[\Livewire\Attributes\On('activate')]
    public function activate($id)
    {
        $user = User::find($id);
        $user->status = 'active';
        $user->save();

        $this->dispatch('showAlert', ['message' => 'User Suspended Successfully']);
    }

    #[\Livewire\Attributes\On('login')]
    public function login($id)
    {
        $user = User::find($id);
        session(['hashed_password' => $user->password]);

        Auth::login($user);

        session(['google' => true]);

        return redirect()->route('user.dashboard.index');
    }


    public function actionRules($row): array
    {
        return [
            // Hide button edit for ID 1
            Rule::button('suspend')
                ->when(fn ($user) => $user->status == 'suspend')
                ->hide(),

            Rule::button('activate')
                ->when(fn ($user) => $user->status == 'active')
                ->hide(),
        ];
    }
}
