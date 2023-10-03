@extends('layouts.app')
@section('title', 'All Deposits')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="direct-referrals-tab" data-bs-toggle="tab"
                            data-bs-target="#direct-referrals" type="button" role="tab" aria-controls="direct-referrals"
                            aria-selected="true">Direct Referrals</button>
                        <button class="nav-link" id="indirect-referrals-tab" data-bs-toggle="tab"
                            data-bs-target="#indirect-referrals" type="button" role="tab"
                            aria-controls="indirect-referrals" aria-selected="false">In-Direct Referrals</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane py-5 fade show active" id="direct-referrals" role="tabpanel"
                        aria-labelledby="direct-referrals-tab">
                        <livewire:user.direct-referrals type="direct" />
                    </div>
                    <div class="tab-pane py-5 fade" id="indirect-referrals" role="tabpanel" aria-labelledby="indirect-referrals-tab">
                        <livewire:user.direct-referrals type="indirect" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
