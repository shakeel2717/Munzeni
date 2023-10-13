@extends('layouts.app')
@section('title', 'All Mining Plans')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <div class="card-body">
                    <h4 class="">@yield('title')</h4>
                    <hr>
                    <div class="my-3">
                        <a href="{{ route('admin.plan.create') }}" class="btn btn-primary">Add New Plan</a>
                    </div>
                    <livewire:admin.all-plans />
                </div>
            </div>
        </div>
    </div>
@endsection
