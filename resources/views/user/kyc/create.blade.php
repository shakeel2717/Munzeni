@extends('layouts.app')
@section('title', 'Withdraw Request')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4>Complete Your KYC</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-body border border-primary">
                                <h4 class="mb-0 text-danger"> <i class="ri-close-circle-fill fs-lage"></i> KYC is Pending</h4>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('user.kyc.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="front">Front Side Document</label>
                            <input type="file" name="front" id="front" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="back">Back Side Document</label>
                            <input type="file" name="back" id="back" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit for Approval</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
