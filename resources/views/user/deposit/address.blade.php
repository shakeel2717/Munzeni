@extends('layouts.app')
@section('title', 'Deposit Funds')
@section('content')
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="">
                <div class="card-body">
                    <h4>@yield('title')</h4>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <p><strong>1. </strong>Please Send <strong>{{ number_format($validatedData['amount'], 2) }} USDT
                                </strong> to the following address</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="py-2 px-3 border border-dashed rounded">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h6 class="fs-md text-truncate">
                                            <a href="#!" class="text-reset">Selected Currency</a>
                                        </h6>
                                        <p class="text-muted mb-0">Network: TRX</p>
                                        <small>Please note that only supported networks on Binance platform are shown, if
                                            you deposit via another network your assets may be lost.</small>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="fs-md text-primary mb-0">USDT TRC20</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="py-2 px-3 border border-dashed rounded">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h6 class="fs-md text-truncate"><a href="#!" class="text-reset">Amount in
                                                USD</a></h6>
                                        <p class="text-muted mb-0">Amount in USD</p>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="fs-md text-primary mb-0">
                                            ${{ number_format($validatedData['amount'], 2) }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body shadow-lg">
                                    <h2 class="card-title mb-0 text-center">
                                        Please Send <strong
                                            class="text-danger">{{ number_format($validatedData['amount'], 2) }}
                                            USDT.TRC20 </strong> to the following Wallet address
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <form action="{{ route('user.deposit.verify') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label for="amount">Wallet Address</label>
                                            <input type="text" name="amount" id="amount"
                                                class="form-control text-center" placeholder="Enter Amount"
                                                value="{{ settings('binance_usdt_deposit_address') }}" readonly>
                                            <small>Send your Funds to This Wallet Address</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label for="hash_id">Transaction ID, Hash ID <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="hash_id" id="hash_id" class="form-control"
                                                placeholder="Enter Your Hash ID">
                                            <small>Enter Your Payment Transaction Id / Reference Id</small>
                                            <input type="hidden" name="amount" value="{{ $validatedData['amount'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-primary btn-label w-100"> Send Deposit Request <i
                                            class="ph-arrow-fat-line-right label-icon align-middle fs-lg me-2"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl={{ settings('binance_usdt_deposit_address') }}&chld=L|1&choe=UTF-8"
                                    alt="Address">
                                <div class="row">
                                    <small>Wallet: {{ settings('binance_usdt_deposit_address') }} & Amount:
                                        ${{ $validatedData['amount'] }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
