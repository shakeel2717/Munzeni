<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="card card-body">
                <div class="live-stats d-flex justify-content-between align-items-center">
                    <div class="left-side" style="min-width: 100%">
                        <h5 class="card-title">Bitcoin Price</h5>
                        {{-- <h2 wire:poll.{{ settings('bitcoin_rate_update') }}s='fetchLiveRate' class="fetchLiveRate">
                            {!! $bitcoinPrice !!}</h2> --}}
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container" wire:ignore>
                            <div class="tradingview-widget-container__widget" style="min-width: 100%"></div>
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-info.js" async>
                                {
                                    "symbol": "BINANCE:BTCUSDT",
                                    "width": "100%",
                                    "locale": "en",
                                    "colorTheme": "dark",
                                    "isTransparent": false
                                }
                            </script>
                        </div>
                        <!-- TradingView Widget END -->
                        <h5 class="card-title mt-4">Account Balance:
                            ${{ number_format(auth()->user()->getBalance(), 2) }}
                        </h5>
                    </div>
                    {{-- <div class="right-spinner">
                        <div class="spinner-border" role="status" wire:loading>
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-0" wire:ignore>
                <div class="tradingview-widget-container">
                    <div id="tradingview_8dffe" style="height: 400px;"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                    <script type="text/javascript">
                        new TradingView.widget({
                            "autosize": true,
                            "symbol": "BINANCE:BTCUSDT",
                            "interval": "1",
                            "timezone": "Etc/UTC",
                            "theme": "dark",
                            "style": "1",
                            "locale": "en",
                            "enable_publishing": false,
                            "hide_top_toolbar": true,
                            "hide_legend": true,
                            "save_image": false,
                            "hide_volume": true,
                            "container_id": "tradingview_8dffe"
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card card-body">
            <ul class="nav nav-pills nav-justified gap-2" role="tablist">
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link {{ $boxType == 'one' ? 'active' : '' }} py-4" data-bs-toggle="tab"
                        href="#five-mi-box" role="tab" wire:click="$set('boxType', 'one')">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="left">
                                <span class="mb-0 display-6 fw-bold">1Mi</span> <br>
                                <span class="text-uppercase">Curt</span>
                            </div>
                            <div class="right" wire:poll.2s='updateOneTimeSecond'>
                                <span class="mb-0 display-6 fw-bold" id="countdown">00:{{ $oneTimeSecond }}</span> <br>
                                <h3 class="mb-0">{{ $timestamp }}</h3>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link {{ $boxType == 'five' ? 'active' : '' }} py-4" data-bs-toggle="tab"
                        href="#profile-1" role="tab" wire:click="$set('boxType', 'five')">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="left">
                                <span class="mb-0 display-6 fw-bold">5Mi</span> <br>
                                <span class="text-uppercase">Long</span>
                            </div>
                            <div class="right">
                                <span class="mb-0 display-6 fw-bold" id="countdown">{{ $fiveTimeSecond }}</span> <br>
                                <h3 class="mb-0">{{ $timestamp }}</h3>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>

            <div class="tab-content py-3 text-muted">
                <div class="tab-pane {{ $boxType == 'one' ? 'active' : '' }}" id="one-mi-box" role="tabpanel">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-body">
                                    <div class="row align-items-around">
                                        @if ($showAmountSection)
                                            <div class="col-md-4">
                                                <h2>Step: 1</h2>
                                                <hr>
                                                <div class="form-group mb-2">
                                                    <label for="amount">Invest Amount</label>
                                                    <input type="text" wire:model="amount" id="amount"
                                                        class="form-control" placeholder="Invest Amount">
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <span wire:click.prevent="$set('amount', '1')"
                                                            class="btn btn-primary btn-sm w-100 mt-2 mt-md-0"
                                                            onclick="document.getElementById('amount').value = '1';">$1</span>
                                                    </div>
                                                    <div class="col">
                                                        <span wire:click="$set('amount', '5')"
                                                            class="btn btn-primary btn-sm w-100 mt-2 mt-md-0"
                                                            onclick="document.getElementById('amount').value = '5';">$5</span>
                                                    </div>
                                                    <div class="col">
                                                        <span wire:click="$set('amount', '10')"
                                                            class="btn btn-primary btn-sm w-100 mt-2 mt-md-0"
                                                            onclick="document.getElementById('amount').value = '10';">$10</span>
                                                    </div>
                                                    <div class="col">
                                                        <span wire:click="$set('amount', '25')"
                                                            class="btn btn-primary btn-sm w-100 mt-2 mt-md-0"
                                                            onclick="document.getElementById('amount').value = '25';">$25</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <span wire:click="$set('amount', '50')"
                                                            class="btn btn-primary btn-sm w-100 mt-2 mt-md-0"
                                                            onclick="document.getElementById('amount').value = '50';">$50</span>
                                                    </div>
                                                    <div class="col">
                                                        <span wire:click="$set('amount', '100')"
                                                            class="btn btn-primary btn-sm w-100 mt-2 mt-md-0"
                                                            onclick="document.getElementById('amount').value = '100';">$100</span>
                                                    </div>
                                                    <div class="col">
                                                        <span wire:click="$set('amount', '500')"
                                                            class="btn btn-primary btn-sm w-100 mt-2 mt-md-0"
                                                            onclick="document.getElementById('amount').value = '500';">$500</span>
                                                    </div>
                                                    <div class="col">
                                                        <span wire:click="$set('amount', '1000')"
                                                            class="btn btn-primary btn-sm w-100 mt-2 mt-md-0"
                                                            onclick="document.getElementById('amount').value = '1000';">$1000</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($showEvenOddSection)
                                            <div class="col-md-4">
                                                <div class="">
                                                    <div class="steps">
                                                        <h2>Step: 2</h2>
                                                        <hr>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="even"
                                                                class="p-3 border border-primary rounded w-100">
                                                                <input type="radio" class="form-check-input"
                                                                    wire:click="$set('type', 'even')" name="type"
                                                                    id="even" value="even">
                                                                EVEN
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="odd"
                                                                class="p-3 border border-primary rounded w-100">
                                                                <input type="radio" class="form-check-input"
                                                                    wire:click="$set('type', 'odd')" name="type"
                                                                    id="odd" value="odd">
                                                                ODD
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h3>Time: {{ strtoupper($boxType) }} Mi</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($showInvestSection)
                                            <div class="col-md-4">
                                                <h2>Step: 3</h2>
                                                <hr>
                                                @if ($type == 'even')
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4 class="d-flex align-items-center gap-2">P:
                                                                <span
                                                                    class="btn btn-primary btn-sm text-uppercase">E</span>
                                                                [
                                                                <span class="btn btn-primary btn-sm">0</span>
                                                                <span class="btn btn-primary btn-sm">2</span>
                                                                <span class="btn btn-primary btn-sm ">4</span>
                                                                <span class="btn btn-primary btn-sm ">6</span>
                                                                <span class="btn btn-primary btn-sm ">8</span>
                                                                ]
                                                            </h4>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($type == 'odd')
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4 class="d-flex align-items-center gap-2">P:
                                                                <span
                                                                    class="btn btn-primary btn-sm text-uppercase">O</span>
                                                                [
                                                                <span class="btn btn-primary btn-sm">1</span>
                                                                <span class="btn btn-primary btn-sm ">3</span>
                                                                <span class="btn btn-primary btn-sm ">5</span>
                                                                <span class="btn btn-primary btn-sm ">7</span>
                                                                <span class="btn btn-primary btn-sm ">9</span>
                                                                ]
                                                            </h4>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4 class="d-flex align-items-center gap-2">
                                                            Total:
                                                            <span class="text-primary">
                                                                ${{ number_format($amount ?? 0, 2) }}
                                                            </span>
                                                        </h4>
                                                        <h4 class="d-flex align-items-center gap-2">
                                                            Type:
                                                            <span class="text-primary">
                                                                {{ ucfirst($type) }}
                                                            </span>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button wire:click='invested'
                                                            class="btn btn-primary btn-lg py-2 mt-2 w-100"
                                                            {{ $disabledOneInvestButton ? 'disabled' : '' }}>INVEST</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <a class="nav-link mb-2 {{ $OneMiBox == 'mytrades' ? 'active' : '' }}"
                                        id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile"
                                        role="tab" aria-controls="v-pills-profile" aria-selected="false"
                                        wire:click="$set('OneMiBox', 'mytrades')">My Trades</a>
                                    <a class="nav-link mb-2 {{ $OneMiBox == 'recent' ? 'active' : '' }}"
                                        id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home"
                                        role="tab" aria-controls="v-pills-home" aria-selected="true"
                                        wire:click="$set('OneMiBox', 'recent')">Recent Trades</a>
                                    <a class="nav-link mb-2 {{ $OneMiBox == 'assist' ? 'active' : '' }}"
                                        id="v-pills-assist-tab" data-bs-toggle="pill" href="#v-pills-assist"
                                        role="tab" aria-controls="v-pills-assist" aria-selected="true"
                                        wire:click="$set('OneMiBox', 'assist')">Assist</a>
                                </div>
                            </div>
                            <div class="col-md-9" style="overflow: scroll;">
                                <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                    <div class="tab-pane fade {{ $OneMiBox == 'mytrades' ? 'show active' : '' }}"
                                        id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        <table class="table table-dark">
                                            <thead>
                                                <tr>
                                                    <th>Time</th>
                                                    <th>Trade Type</th>
                                                    <th>Amount</th>
                                                    <th>Profit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($myOrderOneHistories as $trade)
                                                    <tr>
                                                        <td>{{ $trade->created_at->format('YmdHi') }}</td>
                                                        <td>{{ strtoupper($trade->type) }}</td>
                                                        <td
                                                            class="{{ $trade->win ? 'text-success' : 'text-danger' }}">
                                                            ${{ number_format($trade->amount, 2) }}</td>
                                                        <td>
                                                            @if ($trade->status)
                                                                <div class="spinner-grow" role="status">
                                                                    <span class="visually-hidden">Loading...</span>
                                                                </div>
                                                            @else
                                                                ${{ number_format($trade->profit, 2) }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade {{ $OneMiBox == 'recent' ? 'show active' : '' }}"
                                        id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <table class="table table-dark">
                                            <thead>
                                                <tr>
                                                    <th>Time</th>
                                                    <th>Price</th>
                                                    <th>Result</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderOneHistories as $history)
                                                    <tr>
                                                        <td>{{ $history->created_at->format('YmdHi') }}</td>
                                                        <td>{{ $history->price }}</td>
                                                        <td><span
                                                                class="bg-primary p-2 rounded-circle text-dark fw-bold">{{ sprintf('%02d', $history->result) }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade {{ $OneMiBox == 'assist' ? 'show active' : '' }}"
                                        id="v-pills-assist" role="tabpanel" aria-labelledby="v-pills-assists-tab">
                                        <table class="table table-dark table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>Time</th>
                                                    <th>Result</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderOneHistories->take(50) as $assist)
                                                    <tr>
                                                        <td>{{ $assist->created_at->format('YmdHi') }}</td>
                                                        <td class="d-flex gap-3">
                                                            @for ($i = 0; $i < 10; $i++)
                                                                <span
                                                                    class="text-circle {{ $i == $assist->result ? 'text-dark bg-primary' : '' }}">{{ $i }}</span>
                                                            @endfor
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane {{ $boxType == 'five' ? 'active' : '' }}" id="profile-1" role="tabpanel">
                    {{-- 5 minute box start --}}
                    <div class="tab-pane {{ $boxType == 'one' ? 'active' : '' }}" id="five-mi-box" role="tabpanel">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-body">
                                        <div class="row align-items-around">
                                            @if ($showAmountSection)
                                                <div class="col-md-4">
                                                    <h2>Step: 1</h2>
                                                    <hr>
                                                    <div class="form-group mb-2">
                                                        <label for="amount">Invest Amount</label>
                                                        <input type="text" wire:model.live="amount" id="amount"
                                                            class="form-control fiveMinuteInput" placeholder="Invest Amount">
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col">
                                                            <span wire:click.prevent="$set('amount', '1')"
                                                                class="btn btn-primary btn-sm w-100 mt-2 mt-md-0" onclick="document.querySelector('.fiveMinuteInput').value = '1';">$1</span>
                                                        </div>
                                                        <div class="col">
                                                            <span wire:click="$set('amount', '5')"
                                                                class="btn btn-primary btn-sm w-100 mt-2 mt-md-0" onclick="document.querySelector('.fiveMinuteInput').value = '5';">$5</span>
                                                        </div>
                                                        <div class="col">
                                                            <span wire:click="$set('amount', '10')"
                                                                class="btn btn-primary btn-sm w-100 mt-2 mt-md-0" onclick="document.querySelector('.fiveMinuteInput').value = '10';">$10</span>
                                                        </div>
                                                        <div class="col">
                                                            <span wire:click="$set('amount', '25')"
                                                                class="btn btn-primary btn-sm w-100 mt-2 mt-md-0" onclick="document.querySelector('.fiveMinuteInput').value = '25';">$25</span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col">
                                                            <span wire:click="$set('amount', '50')"
                                                                class="btn btn-primary btn-sm w-100 mt-2 mt-md-0" onclick="document.querySelector('.fiveMinuteInput').value = '50';">$50</span>
                                                        </div>
                                                        <div class="col">
                                                            <span wire:click="$set('amount', '100')"
                                                                class="btn btn-primary btn-sm w-100 mt-2 mt-md-0" onclick="document.querySelector('.fiveMinuteInput').value = '100';">$100</span>
                                                        </div>
                                                        <div class="col">
                                                            <span wire:click="$set('amount', '500')"
                                                                class="btn btn-primary btn-sm w-100 mt-2 mt-md-0" onclick="document.querySelector('.fiveMinuteInput').value = '500';">$500</span>
                                                        </div>
                                                        <div class="col">
                                                            <span wire:click="$set('amount', '1000')"
                                                                class="btn btn-primary btn-sm w-100 mt-2 mt-md-0" onclick="document.querySelector('.fiveMinuteInput').value = '1000';">$1000</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($showEvenOddSection)
                                                <div class="col-md-4">
                                                    <div class="">
                                                        <div class="steps">
                                                            <h2>Step: 2</h2>
                                                            <hr>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="even"
                                                                    class="p-3 border border-primary rounded w-100">
                                                                    <input type="radio" class="form-check-input"
                                                                        wire:click="$set('type', 'even')"
                                                                        name="type" id="even" value="even">
                                                                    EVEN
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="odd"
                                                                    class="p-3 border border-primary rounded w-100">
                                                                    <input type="radio" class="form-check-input"
                                                                        wire:click="$set('type', 'odd')"
                                                                        name="type" id="odd" value="odd">
                                                                    ODD
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h3>Time: {{ strtoupper($boxType) }} Mi</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($showInvestSection)
                                                <div class="col-md-4">
                                                    <h2>Step: 3</h2>
                                                    <hr>
                                                    @if ($type == 'even')
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h4 class="d-flex align-items-center gap-2">P:
                                                                    <span
                                                                        class="btn btn-primary btn-sm text-uppercase">O</span>
                                                                    [
                                                                    <span class="btn btn-primary btn-sm">0</span>
                                                                    <span class="btn btn-primary btn-sm">2</span>
                                                                    <span class="btn btn-primary btn-sm ">4</span>
                                                                    <span class="btn btn-primary btn-sm ">6</span>
                                                                    <span class="btn btn-primary btn-sm ">8</span>
                                                                    ]
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($type == 'odd')
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h4 class="d-flex align-items-center gap-2">P:
                                                                    <span
                                                                        class="btn btn-primary btn-sm text-uppercase">E</span>
                                                                    [
                                                                    <span class="btn btn-primary btn-sm">1</span>
                                                                    <span class="btn btn-primary btn-sm ">3</span>
                                                                    <span class="btn btn-primary btn-sm ">5</span>
                                                                    <span class="btn btn-primary btn-sm ">7</span>
                                                                    <span class="btn btn-primary btn-sm ">9</span>
                                                                    ]
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4 class="d-flex align-items-center gap-2">
                                                                Total:
                                                                <span class="text-primary">
                                                                    ${{ number_format($amount ?? 0, 2) }}
                                                                </span>
                                                            </h4>
                                                            <h4 class="d-flex align-items-center gap-2">
                                                                Type:
                                                                <span class="text-primary">
                                                                    {{ ucfirst($type) }}
                                                                </span>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button wire:click='invested'
                                                                class="btn btn-primary btn-lg py-2 mt-2 w-100"
                                                                {{ $disabledFiveInvestButton ? 'disabled' : '' }}>INVEST</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <a class="nav-link mb-2 {{ $FiveMiBox == 'mytrades' ? 'active' : '' }}"
                                            id="my-one-trade-tab" data-bs-toggle="pill" href="#my-one-trade"
                                            role="tab" aria-controls="my-one-trade" aria-selected="false"
                                            wire:click="$set('FiveMiBox', 'mytrades')">My
                                            Trades</a>
                                        <a class="nav-link mb-2 {{ $FiveMiBox == 'recent' ? 'active' : '' }}"
                                            id="my-five-recent-trades-tab" data-bs-toggle="pill"
                                            href="#my-five-recent-trades" role="tab"
                                            aria-controls="my-five-recent-trades" aria-selected="true"
                                            wire:click="$set('FiveMiBox', 'recent')">Recent
                                            Trades</a>
                                        <a class="nav-link mb-2 {{ $FiveMiBox == 'assist' ? 'active' : '' }}"
                                            id="v-pills-five-assist-tab" data-bs-toggle="pill"
                                            href="#v-pills-five-assist" role="tab"
                                            aria-controls="v-pills-five-assist" aria-selected="true"
                                            wire:click="$set('FiveMiBox', 'assist')">Assist</a>
                                    </div>
                                </div>
                                <div class="col-md-9" style="overflow: scroll;">
                                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                        <div class="tab-pane fade {{ $FiveMiBox == 'mytrades' ? 'show active' : '' }}"
                                            id="my-one-trade" role="tabpanel" aria-labelledby="my-one-trade-tab">
                                            <table class="table table-dark">
                                                <thead>
                                                    <tr>
                                                        <th>Time</th>
                                                        <th>Trade Type</th>
                                                        <th>Amount</th>
                                                        <th>Profit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($myOrderFiveHistories as $trade)
                                                        <tr>
                                                            <td>{{ $trade->created_at->format('YmdHi') }}</td>
                                                            <td>{{ strtoupper($trade->type) }}</td>
                                                            <td
                                                                class="{{ $trade->win ? 'text-success' : 'text-danger' }}">
                                                                ${{ number_format($trade->amount, 2) }}</td>
                                                            <td>
                                                                @if ($trade->status)
                                                                    <div class="spinner-grow" role="status">
                                                                        <span class="visually-hidden">Loading...</span>
                                                                    </div>
                                                                @else
                                                                    ${{ number_format($trade->profit, 2) }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade {{ $FiveMiBox == 'recent' ? 'show active' : '' }}"
                                            id="my-five-recent-trades" role="tabpanel"
                                            aria-labelledby="my-five-recent-trades-tab">
                                            <table class="table table-dark">
                                                <thead>
                                                    <tr>
                                                        <th>Time</th>
                                                        <th>Price</th>
                                                        <th>Result</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orderFiveHistories as $history)
                                                        <tr>
                                                            <td>{{ $history->created_at->format('YmdHi') }}</td>
                                                            <td>{{ $history->price }}</td>
                                                            <td><span
                                                                    class="bg-primary p-2 rounded-circle text-dark fw-bold">{{ sprintf('%02d', $history->result) }}</span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade {{ $FiveMiBox == 'assist' ? 'show active' : '' }}"
                                            id="v-pills-five-assist" role="tabpanel"
                                            aria-labelledby="v-pills-five-assist-tab">
                                            <table class="table table-dark">
                                                <thead>
                                                    <tr>
                                                        <th>Time</th>
                                                        <th>Result</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orderFiveHistories->take(50) as $assist)
                                                        <tr>
                                                            <td>{{ $assist->created_at->format('YmdHi') }}</td>
                                                            <td class="d-flex gap-3">
                                                                @for ($i = 0; $i < 10; $i++)
                                                                    <span
                                                                        class="text-circle {{ $i == $assist->result ? 'text-dark bg-primary' : '' }}">{{ $i }}</span>
                                                                @endfor
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- 5 minute box end --}}
                </div>
            </div>
        </div>
    </div>

</div>
