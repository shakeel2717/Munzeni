@extends('layouts.app')
@section('title', 'Withdraw Request')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4>Update Profile Record</h4>
                    <hr>
                    <form action="{{ route('user.profile.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Full Name"
                                value="{{ auth()->user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username"
                                value="{{ auth()->user()->username }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email"
                                value="{{ auth()->user()->email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="upliner">Upliner</label>
                            <input type="text" name="upliner" id="upliner" class="form-control"
                                placeholder="Upliner Name" value="{{ auth()->user()->refer }}" readonly>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Profile Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
