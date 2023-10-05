@extends('layouts.app')
@section('title', 'Pending Withdrawals')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h2 class="card-title">@yield('title')</h2>
                <hr>
                <livewire:admin.all-transaction type="withdraw" status="1" />
            </div>
        </div>
    </div>
@endsection
