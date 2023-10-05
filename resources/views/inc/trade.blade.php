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
                        <div class="">
                            <div class="steps">
                                <h2>Step: 2</h2>
                                <hr>
                            </div>
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
                                    <h4 class="d-flex align-items-center gap-2">PORTFOLIO:
                                        <span class="btn btn-primary btn-sm text-uppercase">E</span>
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
                                    <h4 class="d-flex align-items-center gap-2">PORTFOLIO:
                                        <span class="btn btn-primary btn-sm text-uppercase">O</span>
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
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="d-flex align-items-center gap-2">Total: <span class="text-primary">
                                        ${{ number_format($amount, 2) }}</span></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button wire:click='invested'
                                    class="btn btn-primary btn-lg py-2 mt-2 w-100">INVEST</button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
