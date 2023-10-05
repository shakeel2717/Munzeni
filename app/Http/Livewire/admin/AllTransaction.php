<?php

namespace App\Http\Livewire\admin;

use App\Models\Transaction;
use App\Models\Withdraw;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class AllTransaction extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    public $type;
    public $status;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
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

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Transaction>
     */
    public function datasource(): Builder
    {
        if ($this->type == 'all') {
            return Transaction::query();
        } else {
            return Transaction::query()->where('type', $this->type)->where('status', $this->status);
        }
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [
            "User" => [
                'username'
            ]
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('user', fn (Transaction $model) => strtolower(e($model->user->username)))
            ->addColumn('type')

            ->addColumn('amount')
            ->addColumn('status')
            ->addColumn('sum')
            ->addColumn('reference')
            ->addColumn('withdraw_id')
            ->addColumn('trading_id')
            ->addColumn('created_at_formatted', fn (Transaction $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('User', 'user'),
            Column::make('Type', 'type')
                ->sortable()
                ->searchable(),

            Column::make('Amount', 'amount')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->toggleable(),

            Column::make('Reference', 'reference')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            Filter::inputText('type')->operators(['contains']),
            Filter::boolean('status'),
            Filter::boolean('sum'),
            Filter::datetimepicker('created_at'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Transaction Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('approve', 'Approve')
                ->class('btn btn-primary btn-sm')
                ->emit('approve', ['id' => 'id']),

            Button::make('reject', 'Reject')
                ->class('btn btn-danger btn-sm')
                ->emit('reject', ['id' => 'id']),
        ];
    }


    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'approve'   => 'approve',
                'reject'   => 'reject',
            ]
        );
    }

    public function approve($id)
    {
        $transaction = Transaction::find($id['id']);

        $withdraw = Withdraw::find($transaction->withdraw_id);
        $withdraw->status = true;
        $withdraw->save();

        $transactions = Transaction::where('withdraw_id', $withdraw->id)->get();
        foreach ($transactions as $transaction) {
            $transaction->status = true;
            $transaction->save();
        }

        $this->dispatchBrowserEvent('showAlert', ['message' => 'Withdraw Request Approved Successfully']);
    }

    public function reject($id)
    {
        $transaction = Transaction::find($id['id']);

        $withdraw = Withdraw::find($transaction->withdraw_id);
        $withdraw->delete();

        $transactions = Transaction::where('withdraw_id', $withdraw->id)->get();
        foreach ($transactions as $transaction) {
            $transaction->delete();
        }

        $this->dispatchBrowserEvent('showAlert', ['message' => 'Withdraw Request Deleted Successfully']);
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Transaction Action Rules.
     *
     * @return array<int, RuleActions>
     */


    public function actionRules(): array
    {
        return [

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
