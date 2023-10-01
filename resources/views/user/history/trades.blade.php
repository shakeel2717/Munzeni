@extends('layouts.app')
@section('title', 'All Deposits')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h2 class="card-title">@yield('title')</h2>
                <hr>
                <livewire:user.all-transactions :type="['trading']" />
            </div>
        </div>
    </div>
@endsection
