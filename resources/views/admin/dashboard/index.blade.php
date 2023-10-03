@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-1 overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">All Users</p>
                            <h4 class="mb-0">{{ $users->count() }}</h4>
                        </div>
                        <div class="text-primary ms-auto">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-1 overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Active Users</p>
                            <h4 class="mb-0">{{ $users->where('status', 'active')->count() }}</h4>
                        </div>
                        <div class="text-primary ms-auto">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-1 overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Pending Users</p>
                            <h4 class="mb-0">{{ $users->where('status', 'pending')->count() }}</h4>
                        </div>
                        <div class="text-primary ms-auto">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-1 overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Total Investment</p>
                            <h4 class="mb-0">${{ number_format($userPlans->sum('amount'), 2) }}</h4>
                        </div>
                        <div class="text-primary ms-auto">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-1 overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Actvie Investment</p>
                            <h4 class="mb-0">${{ number_format($userPlans->where('status', true)->sum('amount'), 2) }}
                            </h4>
                        </div>
                        <div class="text-primary ms-auto">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-1 overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Expired Investment</p>
                            <h4 class="mb-0">${{ number_format($userPlans->where('status', false)->sum('amount'), 2) }}
                            </h4>
                        </div>
                        <div class="text-primary ms-auto">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-1 overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Total Withdrawals</p>
                            <h4 class="mb-0">
                                ${{ number_format($transactions->where('type', 'withdraw')->sum('amount'), 2) }}
                            </h4>
                        </div>
                        <div class="text-primary ms-auto">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-1 overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Approved Withdrawals</p>
                            <h4 class="mb-0">
                                ${{ number_format($transactions->where('type', 'withdraw')->where('status', true)->sum('amount'),2) }}
                            </h4>
                        </div>
                        <div class="text-primary ms-auto">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-1 overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Pending Withdrawals</p>
                            <h4 class="mb-0">
                                ${{ number_format($transactions->where('type', 'withdraw')->where('status', false)->sum('amount'),2) }}
                            </h4>
                        </div>
                        <div class="text-primary ms-auto">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-1 overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Total Deposit</p>
                            <h4 class="mb-0">
                                ${{ number_format($transactions->where('type', 'deposit')->sum('amount'), 2) }}
                            </h4>
                        </div>
                        <div class="text-primary ms-auto">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-1 overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Approved Deposit</p>
                            <h4 class="mb-0">
                                ${{ number_format($transactions->where('type', 'deposit')->where('status', true)->sum('amount'),2) }}
                            </h4>
                        </div>
                        <div class="text-primary ms-auto">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-1 overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Pending Deposit</p>
                            <h4 class="mb-0">
                                ${{ number_format($transactions->where('type', 'deposit')->where('status', false)->sum('amount'),2) }}
                            </h4>
                        </div>
                        <div class="text-primary ms-auto">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-1 overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Total Trading</p>
                            <h4 class="mb-0">
                                ${{ number_format($transactions->where('type', 'trading')->sum('amount'), 2) }}
                            </h4>
                        </div>
                        <div class="text-primary ms-auto">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-1 overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Total Trading Win</p>
                            <h4 class="mb-0">
                                ${{ number_format($transactions->where('type', 'trading profit')->sum('amount'), 2) }}
                            </h4>
                        </div>
                        <div class="text-primary ms-auto">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-1 overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">Total Trading Loss</p>
                            <h4 class="mb-0">
                                ${{ number_format($trading->where('win', false)->sum('amount'), 2) }}
                            </h4>
                        </div>
                        <div class="text-primary ms-auto">
                            <i class="ri-stack-line font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
