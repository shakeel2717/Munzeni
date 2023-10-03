@extends('layouts.app')
@section('title', 'All Kyc Request')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <div class="card-body">
                    <h4 class="">@yield('title')</h4>
                    <livewire:admin.all-kyc-request/>
                </div>
            </div>
        </div>
    </div>
@endsection
