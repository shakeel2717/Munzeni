@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="card card-body shadow-sm border-0">
                <div class="row">
                    <div class="col text-start">
                        <h2>Download the {{ env('APP_NAME') }} Mobile App</h2>
                        <p class="mb-0">And Trade while you are on the go</p>
                    </div>
                    <div class="col text-center text-md-end mt-4 mt-md-0">
                        <a href="{{ settings('app_download_link') }}"><img src="{{ asset('assets/google.webp') }}" alt="Google Play Store" width="200"></a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-truncate font-size-14 mb-2">Available Balance</p>
                            <h4 class="mb-0">${{ number_format(auth()->user()->getBalance(),2) }}</h4>
                        </div>
                        <i class="bi bi-wallet2 fs-2"></i>
                    </div>
                    <div class="text-primary ms-auto">
                        <i class="ri-stack-line font-size-24"></i>
                    </div>
                </div>
                <div class="card-body bg-half-dark py-3">
                    <a href="{{ route('user.history.deposits') }}" class="text-white">See All Transactions</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-truncate font-size-14 mb-2">Total Income</p>
                            <h4 class="mb-0">${{ number_format(auth()->user()->allIncome(),2) }}</h4>
                        </div>
                        <i class="bi bi-wallet2 fs-2"></i>
                    </div>
                    <div class="text-primary ms-auto">
                        <i class="ri-stack-line font-size-24"></i>
                    </div>
                </div>
                <div class="card-body bg-half-dark py-3">
                    <a href="{{ route('user.history.deposits') }}" class="text-white">See All Transactions</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-truncate font-size-14 mb-2">Total Withdarawls</p>
                            <h4 class="mb-0">${{ number_format(auth()->user()->allWithdraw(),2) }}</h4>
                        </div>
                        <i class="bi bi-wallet2 fs-2"></i>
                    </div>
                    <div class="text-primary ms-auto">
                        <i class="ri-stack-line font-size-24"></i>
                    </div>
                </div>
                <div class="card-body bg-half-dark py-3">
                    <a href="{{ route('user.history.deposits') }}" class="text-white">See All Transactions</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-truncate font-size-14 mb-2">Total Daily Profit</p>
                            <h4 class="mb-0">${{ number_format(auth()->user()->totalProfit(),2) }}</h4>
                        </div>
                        <i class="bi bi-wallet2 fs-2"></i>
                    </div>
                    <div class="text-primary ms-auto">
                        <i class="ri-stack-line font-size-24"></i>
                    </div>
                </div>
                <div class="card-body bg-half-dark py-3">
                    <a href="{{ route('user.history.deposits') }}" class="text-white">See All Transactions</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-truncate font-size-14 mb-2">Today Daily Profit</p>
                            <h4 class="mb-0">${{ number_format(auth()->user()->totalTodayProfit(),2) }}</h4>
                        </div>
                        <i class="bi bi-wallet2 fs-2"></i>
                    </div>
                    <div class="text-primary ms-auto">
                        <i class="ri-stack-line font-size-24"></i>
                    </div>
                </div>
                <div class="card-body bg-half-dark py-3">
                    <a href="{{ route('user.history.deposits') }}" class="text-white">See All Transactions</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-truncate font-size-14 mb-2">Total Direct Commission</p>
                            <h4 class="mb-0">${{ number_format(auth()->user()->directCommission(),2) }}</h4>
                        </div>
                        <i class="bi bi-wallet2 fs-2"></i>
                    </div>
                    <div class="text-primary ms-auto">
                        <i class="ri-stack-line font-size-24"></i>
                    </div>
                </div>
                <div class="card-body bg-half-dark py-3">
                    <a href="{{ route('user.history.deposits') }}" class="text-white">See All Transactions</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body overflow-scroll">
                <h2 class="card-title">Recent Transactions</h2>
                <hr>
                <table class="table table-responsive table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Reference</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (auth()->user()->transactions()->orderBy('id','desc')->take(8)->get() as $transaction)
                            <tr>
                                <td class="text-uppercase">{{ $transaction->type }}</td>
                                <td class="{{ $transaction->sum ? 'text-success' : 'text-danger' }}">
                                    ${{ number_format($transaction->amount, 2) }}</td>
                                <td class="{{ $transaction->status ? 'text-success' : 'text-danger' }}">{{ $transaction->status ? "Approved" : "Pending" }}</td>
                                <td>{{ $transaction->reference }}</td>
                                <td>{{ $transaction->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No Record Found</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body overflow-scroll">
                <h2 class="card-title">Mining Plans</h2>
                <hr>
                <table class="table table-responsive table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Plan Name</th>
                            <th>Invested Amount</th>
                            <th>Status</th>
                            <th>Activated at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (auth()->user()->userPlan()->orderBy('id','desc')->get() as $userPlan)
                            <tr>
                                <td class="text-uppercase">{{ $userPlan->plan->name }}</td>
                                <td>${{ number_format($userPlan->amount, 2) }}</td>
                                <td class="{{ $userPlan->status ? 'text-success' : 'text-danger' }}">
                                    {{ $userPlan->status ? 'Active' : 'Expired' }}</td>
                                <td>{{ $userPlan->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No Record Found</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-body">
                    <h3 class="text-center">Deposit Bonus</h3>
                    <p>{{ settings('welcome_modal_text_1') }}</p>
                    <p>{{ settings('welcome_modal_text_2') }}</p>
                    <div class="text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if (session('showNotification'))
        <script>
            window.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                myModal.show();
            });
        </script>
    @endif
@endsection
