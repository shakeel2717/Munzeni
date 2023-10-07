@extends('layouts.app')
@section('title', 'Withdraw Request')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="">
                <div class="card-body">
                    <h4>Withdraw Funds</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-body border border-primary">
                                <h4>You Wallet Address</h4>
                                <hr>
                                <p>{{ auth()->user()->wallet->wallet ?? 'Not Updated Yet!' }} <a
                                        href="{{ route('user.wallet.index') }}" class="btn btn-primary btn-sm">Change</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Withdraw Fees: {{ settings('withdraw_fees') }}%</h5>
                            <p>Withdrawal process duration typically spans from 10 minutes to approximately 24 hours</p>
                        </div>
                    </div>
                    <form action="{{ route('user.withdraw.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount">
                        </div>
                        @if (auth()->user()->authenticator)
                            <div class="form-group">
                                <label for="code">Google Authenticator Code</label>
                                <input type="text" name="code" id="code" class="form-control"
                                    placeholder="Google Authenticator Code">
                            </div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Withdraw Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
