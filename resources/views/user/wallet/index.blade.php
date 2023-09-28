@extends('layouts.app')
@section('title', 'Withdraw Request')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4>Withdraw Funds</h4>
                    <hr>
                    <form action="{{ route('user.wallet.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="currency_id">Select Currency</label>
                            <select name="currency_id" id="currency_id" class="form-control">
                                @foreach ($currencies as $currency)
                                    <option value="{{ $currency->id }}" @if (isset(auth()->user()->wallet) && auth()->user()->wallet->currency_id == $currency->id) selected @endif>
                                        {{ $currency->name }} (Network:
                                        {{ $currency->network }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="wallet">Wallet Address</label>
                            <input type="text" name="wallet" id="wallet" class="form-control"
                                placeholder="Enter Currency Wallet Address"
                                value="{{ auth()->user()->wallet->wallet ?? '' }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Wallet Address</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
