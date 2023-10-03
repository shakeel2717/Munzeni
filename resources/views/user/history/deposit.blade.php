@extends('layouts.app')
@section('title', 'All Deposits')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="deposit-history-tab" data-bs-toggle="tab"
                            data-bs-target="#deposit-history" type="button" role="tab" aria-controls="deposit-history"
                            aria-selected="true">Deposit
                            History</button>
                        <button class="nav-link" id="withdraw-history-tab" data-bs-toggle="tab"
                            data-bs-target="#withdraw-history" type="button" role="tab"
                            aria-controls="withdraw-history" aria-selected="false">Withdraw
                            History</button>
                        <button class="nav-link" id="trading-history-tab" data-bs-toggle="tab"
                            data-bs-target="#trading-history" type="button" role="tab" aria-controls="trading-history"
                            aria-selected="false">Trading
                            History</button>
                        <button class="nav-link" id="direct-commission-history-tab" data-bs-toggle="tab"
                            data-bs-target="#direct-commission-history" type="button" role="tab"
                            aria-controls="direct-commission-history" aria-selected="false">Direct Commission</button>
                        <button class="nav-link" id="indirect-commission-history-tab" data-bs-toggle="tab"
                            data-bs-target="#indirect-commission-history" type="button" role="tab"
                            aria-controls="indirect-commission-history" aria-selected="false">In-Direct Commission</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane py-5 fade show active" id="deposit-history" role="tabpanel"
                        aria-labelledby="deposit-history-tab">
                        <livewire:user.all-transaction :type="['deposit']" />
                    </div>
                    <div class="tab-pane py-5 fade" id="withdraw-history" role="tabpanel" aria-labelledby="withdraw-history-tab">
                        <livewire:user.all-transaction :type="['withdraw', 'withdraw fees']" />
                    </div>
                    <div class="tab-pane py-5 fade" id="trading-history" role="tabpanel" aria-labelledby="trading-history-tab">
                        <livewire:user.all-transaction :type="['trading']" />
                    </div>
                    <div class="tab-pane py-5 fade" id="direct-commission-history" role="tabpanel"
                        aria-labelledby="direct-commission-history-tab">
                        <livewire:user.all-transaction :type="['direct commission']" />
                    </div>
                    <div class="tab-pane py-5 fade" id="indirect-commission-history" role="tabpanel"
                        aria-labelledby="indirect-commission-history-tab">
                        <livewire:user.all-transaction :type="['indirect commission']" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
