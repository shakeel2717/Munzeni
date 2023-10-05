@extends('layouts.app')
@section('title', 'Deposit Funds')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="">
                <div class="card-body">
                    <h4>@yield('title')</h4>
                    <hr>
                    <form action="{{ route('user.deposit.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="amount">Amount (USDT)</label>
                            <input type="text" name="amount" id="amount" class="form-control" placeholder="USDT Amount">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Deposit now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
