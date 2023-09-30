@extends('layouts.app')
@section('title', 'All Kyc Request')
@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="">@yield('title')</h4>
                    <livewire:admin.all-kyc/>
                </div>
            </div>
        </div>
    </div>
@endsection
