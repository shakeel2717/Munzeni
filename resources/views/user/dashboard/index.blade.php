@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Available Balance</p>
                            <h4 class="mb-0">${{ number_format(auth()->user()->getBalance(),2) }}</h4>
                        </div>
                        <div class="text-primary">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>

                <div class="card-body border-top py-3">
                    <div class="text-truncate">
                        <span class="text-muted ml-2"><a href="#">See All Transactions</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Total Income</p>
                            <h4 class="mb-0">${{ number_format(auth()->user()->allIncome(),2) }}</h4>
                        </div>
                        <div class="text-primary">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>

                <div class="card-body border-top py-3">
                    <div class="text-truncate">
                        <span class="text-muted ml-2"><a href="#">See All Transactions</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Total Withdarawls</p>
                            <h4 class="mb-0">${{ number_format(auth()->user()->allWithdraw(),2) }}</h4>
                        </div>
                        <div class="text-primary">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>

                <div class="card-body border-top py-3">
                    <div class="text-truncate">
                        <span class="text-muted ml-2"><a href="#">See All Transactions</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Total Daily Profit</p>
                            <h4 class="mb-0">${{ number_format(auth()->user()->totalProfit(),2) }}</h4>
                        </div>
                        <div class="text-primary">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>

                <div class="card-body border-top py-3">
                    <div class="text-truncate">
                        <span class="text-muted ml-2"><a href="#">See All Transactions</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Today Daily Profit</p>
                            <h4 class="mb-0">${{ number_format(auth()->user()->totalTodayProfit(),2) }}</h4>
                        </div>
                        <div class="text-primary">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>

                <div class="card-body border-top py-3">
                    <div class="text-truncate">
                        <span class="text-muted ml-2"><a href="#">See All Transactions</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Total Direct Commission</p>
                            <h4 class="mb-0">${{ number_format(auth()->user()->directCommission(),2) }}</h4>
                        </div>
                        <div class="text-primary">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>

                <div class="card-body border-top py-3">
                    <div class="text-truncate">
                        <span class="text-muted ml-2"><a href="#">See All Transactions</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
