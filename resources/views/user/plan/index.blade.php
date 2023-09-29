@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="text-center mb-5">
                <h4>Mining Pricing Plans</h4>
                <p class="text-muted mb-4">Choose Best Plan that suite for you.</p>

            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        @foreach ($plans as $plan)
            <div class="col-xl-4 col-sm-6">
                <div class="card pricing-box">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <div class="mt-3">
                                <i class="ri-edit-box-line text-primary h1"></i>
                            </div>
                            <h5 class="mt-4">{{ $plan->name }} Plan</h5>

                            <div class="font-size-14 mt-4 pt-2">
                                <ul class="list-unstyled plan-features">
                                    <li>Min Investment: ${{ number_format($plan->min_invest, 2) }}</li>
                                    <li>Max Investment: ${{ number_format($plan->max_invest, 2) }}</li>
                                    <li>Instant Withdrawal</li>
                                    <li>Daily Withdrawal</li>
                                    <li>Min Withdrawals : {{ settings('min_withdraw') }}</li>
                                </ul>
                            </div>

                            <div class="mt-5">
                                <h1 class="fw-bold mb-1"><sup class="mr-1"><small>$</small></sup>{{ $plan->min_invest }} -
                                    <sup class="mr-1"><small>$</small></sup>{{ $plan->max_invest }}
                                </h1>
                                <p class="text-muted">Per month</p>
                            </div>

                            <div class="mt-5 mb-3">
                                <form action="{{ route('user.plan.store') }}" method="POST">
                                    @csrf
                                    <div class="input-group px-5">
                                        <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                        <input type="number" class="form-control" name="amount"
                                            placeholder="Amount to Invest" min="{{ $plan->min_invest }}"
                                            max="{{ $plan->max_invest }}">
                                        <button btn class="btn btn-primary w-md">Invest Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
