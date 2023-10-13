@extends('layouts.app')
@section('title', 'Add New Mining Plan')
@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="">
                <div class="card-body">
                    <h4 class="">@yield('title')</h4>
                    <hr>
                    <form action="{{ route('admin.plan.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Plan Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Plan Name">
                        </div>

                        <div class="form-group">
                            <label for="profit">Plan Profit</label>
                            <input type="text" name="profit" id="profit" class="form-control"
                                placeholder="Plan Profit">
                        </div>

                        <div class="form-group">
                            <label for="duration">Plan Duration</label>
                            <input type="text" name="duration" id="duration" class="form-control"
                                placeholder="Plan Duration">
                        </div>

                        <div class="form-group">
                            <label for="min_invest">Plan Min Investment</label>
                            <input type="text" name="min_invest" id="min_invest" class="form-control"
                                placeholder="Plan Min Investment">
                        </div>

                        <div class="form-group">
                            <label for="max_invest">Plan Max Investment</label>
                            <input type="text" name="max_invest" id="max_invest" class="form-control"
                                placeholder="Plan Max Investment">
                        </div>

                        <div class="form-group">
                            <label for="return">Return Principal Amount</label>
                            <select name="return" id="return" class="form-control">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="special">Special Package (Can be active once)</label>
                            <select name="special" id="special" class="form-control">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
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
