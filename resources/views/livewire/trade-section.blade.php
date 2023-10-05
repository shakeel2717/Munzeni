<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="card card-body">
                <div class="live-stats d-flex justify-content-between align-items-center">
                    <div class="left-side">
                        <h5 class="card-title">Bitcoin Price</h5>
                        <h2 wire:poll.{{ settings('bitcoin_rate_update') }}s='fetchLiveRate' class="fetchLiveRate">
                            {!! $bitcoinPrice !!}</h2>
                        <!-- TradingView Widget BEGIN -->
                        {{-- <div class="tradingview-widget-container">
                            <div class="tradingview-widget-container__widget"></div>
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-single-quote.js" async>
                                {
                                    "symbol": "BINANCE:BTCUSDT",
                                    "width": "100%",
                                    "height": "100%",
                                    "colorTheme": "dark",
                                    "isTransparent": false,
                                    "locale": "en"
                                }
                            </script>
                        </div> --}}
                        <!-- TradingView Widget END -->
                        <h5 class="card-title">Account Balance: ${{ number_format(auth()->user()->getBalance(),2) }}
                        </h5>
                    </div>
                    <div class="right-spinner">
                        <div class="spinner-border" role="status" wire:loading>
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-0" wire:ignore style="height: 400px;">
                <div class="tradingview-widget-container">
                    <div id="tradingview_8dffe"></div>
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
                            <div class="right">
                                <span class="mb-0 display-6 fw-bold">00:00:00</span> <br>
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
                                <span class="mb-0 display-6 fw-bold">00:00:00</span> <br>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>

            <div class="tab-content py-3 text-muted">
                <div class="tab-pane {{ $boxType == 'one' ? 'active' : '' }}" id="one-mi-box" role="tabpanel">
                    <div class="card card-body">
                        @include('inc.trade')
                        <div class="row">
                            <div class="col-md-3">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <a class="nav-link mb-2 active" id="v-pills-profile-tab" data-bs-toggle="pill"
                                        href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                                        aria-selected="false">My Trades</a>
                                    <a class="nav-link mb-2" id="v-pills-home-tab" data-bs-toggle="pill"
                                        href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                                        aria-selected="true">Recent Trades</a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel"
                                        aria-labelledby="v-pills-profile-tab">
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
                                                        <td>{{ $trade->created_at->diffForHumans() }}</td>
                                                        <td>{{ strtoupper($trade->type) }}</td>
                                                        <td class="{{ $trade->win ? 'text-success' : 'text-danger' }}">
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
                                    <div class="tab-pane fade" id="v-pills-home" role="tabpanel"
                                        aria-labelledby="v-pills-home-tab">
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
                                                        <td>{{ $history->created_at->diffForHumans() }}</td>
                                                        <td>{{ $history->price }}</td>
                                                        <td><span
                                                                class="bg-primary p-2 rounded-circle text-white fw-bold">{{ sprintf('%02d', $history->result) }}</span>
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
                            @include('inc.trade')
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <a class="nav-link mb-2 active" id="my-one-trade-tab" data-bs-toggle="pill"
                                            href="#my-one-trade" role="tab" aria-controls="my-one-trade"
                                            aria-selected="false">My Trades</a>
                                        <a class="nav-link mb-2" id="my-five-recent-trades-tab" data-bs-toggle="pill"
                                            href="#my-five-recent-trades" role="tab"
                                            aria-controls="my-five-recent-trades" aria-selected="true">Recent
                                            Trades</a>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="my-one-trade" role="tabpanel"
                                            aria-labelledby="my-one-trade-tab">
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
                                                            <td>{{ $trade->created_at->diffForHumans() }}</td>
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
                                        <div class="tab-pane fade" id="my-five-recent-trades" role="tabpanel"
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
                                                            <td>{{ $history->created_at->diffForHumans() }}</td>
                                                            <td>{{ $history->price }}</td>
                                                            <td><span
                                                                    class="bg-primary p-2 rounded-circle text-white fw-bold">{{ sprintf('%02d', $history->result) }}</span>
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
