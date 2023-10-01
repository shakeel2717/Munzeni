<?php

namespace App\Livewire;

use App\Models\TradeHistory;
use Livewire\Component;

class TradeSection extends Component
{

    public $orderOneHistories;
    public $orderFiveHistories;
    public $amount = 5;

    public function mount()
    {
        $this->orderOneHistories = TradeHistory::where('type', 'one')->get();
        $this->orderFiveHistories = TradeHistory::where('type', 'five')->get();
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function render()
    {
        return view('livewire.trade-section');
    }
}
