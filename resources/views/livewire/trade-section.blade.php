<div class="row">
    <div class="col-md-6">
        <div class="col-md-12">
            <div class="card card-body">
                <h2 class="card-title">Bitcoin Price</h2>
                <h2 wire:poll.5s='fetchLiveRate' class="fetchLiveRate">{{ number_format($bitcoinPrice, 2) }}</h2>
                <h2 class="card-title">Account Balance: ${{ number_format(auth()->user()->getBalance(),2) }}</h2>
                <div class="card">
                    <div class="card-body" wire:ignore>
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                            <div id="tradingview_8dffe" style="height: 250px;"></div>
                            <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                            <script type="text/javascript">
                                new TradingView.widget({
                                    "autosize": true,
                                    "symbol": "BINANCE:BTCUSDT",
                                    "interval": "1",
                                    "timezone": "Etc/UTC",
                                    "theme": "light",
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
                        <!-- TradingView Widget END -->
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-body">
            <ul class="nav nav-pills nav-justified" role="tablist">
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link active py-4" data-bs-toggle="tab" href="#home-1" role="tab">
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
                    <a class="nav-link py-4" data-bs-toggle="tab" href="#profile-1" role="tab">
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
                <div class="tab-pane active" id="home-1" role="tabpanel">
                    <h2 class="mb-0 text-white bg-primary p-2">Recent Transactions</h2>
                    <div class="card card-body">
                        <table class="table">
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
                <div class="tab-pane" id="profile-1" role="tabpanel">
                    <h2 class="mb-0 text-white bg-primary p-2">Recent Transactions</h2>
                    <div class="card card-body">
                        <table class="table">
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
    <div class="col-md-12">
        <div class="card card-body">
            <div class="row align-items-center">
                @if ($showAmountSection)
                    <div class="col-md-4">
                        <h2>Step: 1</h2>
                        <hr>
                        <div class="form-group mb-2">
                            <label for="amount">Invest Amount</label>
                            <input type="text" wire:model="amount" id="amount" class="form-control"
                                placeholder="Invest Amount">
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <span wire:click.prevent="$set('amount', '1')"
                                    class="btn btn-primary btn-sm w-100">$1</span>
                            </div>
                            <div class="col">
                                <span wire:click="$set('amount', '5')" class="btn btn-primary btn-sm w-100">$5</span>
                            </div>
                            <div class="col">
                                <span wire:click="$set('amount', '10')" class="btn btn-primary btn-sm w-100">$10</span>
                            </div>
                            <div class="col">
                                <span wire:click="$set('amount', '25')" class="btn btn-primary btn-sm w-100">$25</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <span wire:click="$set('amount', '50')" class="btn btn-primary btn-sm w-100">$50</span>
                            </div>
                            <div class="col">
                                <span wire:click="$set('amount', '100')"
                                    class="btn btn-primary btn-sm w-100">$100</span>
                            </div>
                            <div class="col">
                                <span wire:click="$set('amount', '500')"
                                    class="btn btn-primary btn-sm w-100">$500</span>
                            </div>
                            <div class="col">
                                <span wire:click="$set('amount', '1000')"
                                    class="btn btn-primary btn-sm w-100">$1000</span>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($showEvenOddSection)
                    <div class="col-md-4">
                        <h2>Step: 2</h2>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="even" class="p-3 border border-primary rounded w-100">
                                    <input type="radio" wire:click="$set('type', 'even')" name="type"
                                        id="even" value="even">
                                    EVEN
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label for="odd" class="p-3 border border-primary rounded w-100">
                                    <input type="radio" wire:click="$set('type', 'odd')" name="type"
                                        id="odd" value="odd">
                                    ODD
                                </label>
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
                                    <h4 class="d-flex align-items-center gap-2">PORTFOLIO: <span
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
                        @if ($type == 'odd')
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="d-flex align-items-center gap-2">PORTFOLIO: <span
                                            class="btn btn-primary btn-sm text-uppercase">O</span>
                                        [
                                        <span class="btn btn-primary btn-sm">2</span>
                                        <span class="btn btn-primary btn-sm ">4</span>
                                        <span class="btn btn-primary btn-sm ">6</span>
                                        <span class="btn btn-primary btn-sm ">8</span>
                                        ]
                                    </h4>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="d-flex align-items-center gap-2">Total: <span class="text-primary">
                                        ${{ number_format($amount, 2) }}</span></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button wire:click='invested'
                                    class="btn btn-primary btn-lg py-4 w-100">INVEST</button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
