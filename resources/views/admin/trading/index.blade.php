@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="">
                <div class="card-body">
                    <h4 class="">Control Future Trading</h4>
                    <hr>
                    <form action="{{ route('admin.trading.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="time">Timestamp</label>
                                    <input type="text" name="timestamp" class="form-control" id="timestamp" value="{{ date('YmdHi') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p>Step 1: Select Trade Type</p>
                            </div>
                            <div class="col-md-6">
                                <label for="one" class="p-3 border border-primary rounded w-100">
                                    <input type="radio" name="trade" id="one" value="one">
                                    One Mi
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label for="five" class="p-3 border border-primary rounded w-100">
                                    <input type="radio" name="trade" id="five" value="five">
                                    Five Mi
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p>Step 2: Select Who Will Winner?</p>
                            </div>
                            <div class="col-md-6">
                                <label for="even" class="p-3 border border-primary rounded w-100">
                                    <input type="radio" name="type" id="even" value="even">
                                    EVEN
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label for="odd" class="p-3 border border-primary rounded w-100">
                                    <input type="radio" name="type" id="odd" value="odd">
                                    ODD
                                </label>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Take Control on Future Trading</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h2 class="card-title">All Future Trading Policy</h2>
                <hr>
                <livewire:admin.all-future-policy/>
            </div>
        </div>
    </div>
@endsection
