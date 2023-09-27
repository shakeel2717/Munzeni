@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="">Add Funds to User Balance</h4>
                    <hr>
                    <form action="{{ route('admin.finance.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                placeholder="Enter User's Username">
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control"
                                placeholder="Enter Amount">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add Balance</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
