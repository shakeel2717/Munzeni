<?php

namespace App\Livewire;

use App\Events\UserInvestInTrading;
use App\Models\TradeHistory;
use App\Models\Trading;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class TradeSection extends Component
{

    public $orderOneHistories;
    public $myOrderOneHistories;
    public $orderFiveHistories;
    public $showAmountSection = true;
    public $showEvenOddSection = false;
    public $showInvestSection = false;

    public $showEvenNumbers = true;
    public $showOddNumbers = false;
    public $amount = 0;
    public $bitcoinPrice;
    public $type;

    public function mount()
    {
        $this->orderOneHistories = TradeHistory::where('type', 'one')->latest()->limit(5)->get();

        $this->myOrderOneHistories = Trading::where('user_id', auth()->user()->id)->latest()->limit(5)->get();

        $this->orderFiveHistories = TradeHistory::where('type', 'five')->latest()->limit(5)->get();

        $this->bitcoinPrice =  0000000;
    }

    public function invested()
    {
        // checking if available balance is enough
        if (auth()->user()->getBalance() < floatval($this->amount)) {
            $this->dispatch('showAlertError', ['message' => 'Insufficient Balance']);
            $this->resetAll();
            return;
        }

        // adding record to database
        // adding balance to this user
        $trading = auth()->user()->tradings()->create([
            'type' => $this->type,
            'amount' => $this->amount,
            'status' => true,
        ]);

        // adding balance to this user
        $transaction = auth()->user()->transactions()->create([
            'trading_id' => $trading->id,
            'type' => 'trading',
            'amount' => $this->amount,
            'sum' => false,
            'status' => false,
            'reference' => "Trading on " . $this->type,
        ]);

        UserInvestInTrading::dispatch($transaction);

        $this->resetAll();

        $this->dispatch('showAlert', ['message' => 'Invested Successfully']);
    }

    public function resetAll()
    {
        $this->showAmountSection = true;
        $this->showEvenOddSection = false;
        $this->showInvestSection = false;
        $this->amount = 0;
    }

    public function updatedAmount()
    {
        $this->showEvenOddSection = true;
    }


    public function updatedType()
    {
        $this->showInvestSection = true;
    }

    public function fetchLiveRate()
    {
        $this->bitcoinPrice =  fetchLiveResult();
        $this->orderOneHistories = TradeHistory::where('type', 'one')->latest()->limit(5)->get();
        $this->orderFiveHistories = TradeHistory::where('type', 'five')->latest()->limit(5)->get();
    }

    public function render()
    {
        return view('livewire.trade-section');
    }
}
