<?php

namespace App\Livewire\Admin;

use App\Models\Transaction;
use App\Models\Withdraw;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class AllTransaction extends PowerGridComponent
{
    use WithExport;

    public $type;
    public $status;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        if ($this->type == 'all') {
            return Transaction::query();
        } else {
            return Transaction::query()->where('type', $this->type)->where('status', $this->status);
        }
    }

    public function relationSearch(): array
    {
        return [
            "User" => [
                'username'
            ]
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('user_id')
            ->add('user', fn (Transaction $model) => strtolower(e($model->user->username)))
            ->add('type')
            ->add('amount')
            ->add('status')
            ->add('sum')
            ->add('reference')
            ->add('withdraw_id')
            ->add('trading_id')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('User id', 'user'),
            Column::make('Type', 'type')
                ->sortable()
                ->searchable(),

            Column::make('Amount', 'amount')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Reference', 'reference')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('type')->operators(['contains']),
            Filter::boolean('status'),
            Filter::boolean('sum'),
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('approve')]
    public function approve($id): void
    {
        $transaction = Transaction::find($id);

        $withdraw = Withdraw::find($transaction->withdraw_id);


        // checking if withdraw is auto or not
        if (!settings('auto_withdrawals')) {
            goto endAutoApproval;
        }



        $apiKey = env('BINANCE_API_KEY');
        $apiSecret = env('BINANCE_API_SECRET');
        $timestamp = round(microtime(true) * 1000);

        $coin = "USDT";
        $network = $withdraw->currency->network;
        $address = $withdraw->wallet;
        $amount = $withdraw->amount + $withdraw->currency->fees;

        $data = [
            'coin' => $coin,
            'network' => $network,
            'address' => $address,
            'amount' => $amount,
            'timestamp' => $timestamp,
        ];

        $signature = hash_hmac('sha256', http_build_query($data), $apiSecret);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.binance.com/sapi/v1/capital/withdraw/apply?coin=' . $coin . '&network=' . $network . '&address=' . $address . '&amount=' . $amount . '&timestamp=' . $timestamp . '&signature=' . $signature,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'X-MBX-APIKEY: ' . $apiKey
            ),
        ));

        $response = curl_exec($curl);
        info($response);

        $apiData = json_decode($response);

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($httpCode == 200) {
            $withdraw->status = true;
            $withdraw->save();

            $transactions = Transaction::where('withdraw_id', $withdraw->id)->get();
            foreach ($transactions as $transaction) {
                $transaction->status = true;
                $transaction->save();
            }
            $this->dispatch('showAlert', ['message' => 'Auto Withdraw Request Approved Successfully']);
            return;
        } else {
            // Request failed
            $this->dispatch('showAlertError', ['message' => 'Withdrawal request failed. HTTP Status Code: '  . json_decode($response)->msg]);
            info("Withdrawal request failed. HTTP Status Code: " . $httpCode . "\n");
            info($response);
            return;
        }

        endAutoApproval:

        $withdraw->status = true;
        $withdraw->save();

        $transactions = Transaction::where('withdraw_id', $withdraw->id)->get();
        foreach ($transactions as $transaction) {
            $transaction->status = true;
            $transaction->save();
        }
        $this->dispatch('showAlert', ['message' => 'Manual Withdraw Request Approved Successfully']);
    }

    #[\Livewire\Attributes\On('reject')]
    public function reject($id): void
    {
        $transaction = Transaction::find($id);

        $withdraw = Withdraw::find($transaction->withdraw_id);
        $withdraw->delete();

        $transactions = Transaction::where('withdraw_id', $withdraw->id)->get();
        foreach ($transactions as $transaction) {
            $transaction->delete();
        }

        $this->dispatch('showAlert', ['message' => 'Withdraw Request Deleted Successfully']);
    }

    public function actions(Transaction $row): array
    {
        return [
            Button::make('approve', 'Approve')
                ->class('btn btn-primary btn-sm')
                ->dispatch('approve', ['id' => $row->id]),

            Button::make('reject', 'Reject')
                ->class('btn btn-danger btn-sm')
                ->dispatch('reject', ['id' => $row->id]),
        ];
    }


    public function actionRules($row): array
    {
        return [
            // Hide button edit for ID 1
            //Hide button edit for ID 1
            Rule::button('approve')
                ->when(fn ($transaction) => $transaction->type != 'withdraw')
                ->hide(),

            Rule::button('reject')
                ->when(fn ($transaction) => $transaction->type != 'withdraw')
                ->hide(),

            Rule::button('approve')
                ->when(fn ($transaction) => $transaction->status != false)
                ->hide(),

            Rule::button('reject')
                ->when(fn ($transaction) => $transaction->status != false)
                ->hide(),
        ];
    }
}
