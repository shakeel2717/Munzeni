<?php

namespace App\Http\Livewire\admin;

use App\Models\Plan;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class AllPlans extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    public $name;
    public $profit;
    public $duration;
    public $min_invest;
    public $max_invest;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        // $this->showCheckBox();

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
     * @return Builder<\App\Models\Plan>
     */
    public function datasource(): Builder
    {
        return Plan::query();
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
        return [];
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
            ->addColumn('name')

            /** Example of custom column using a closure **/
            ->addColumn('name_lower', fn (Plan $model) => strtolower(e($model->name)))

            ->addColumn('profit')
            ->addColumn('duration')
            ->addColumn('min_invest')
            ->addColumn('max_invest')
            ->addColumn('return')
            ->addColumn('created_at_formatted', fn (Plan $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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
            Column::make('Name', 'name')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Profit', 'profit')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Duration', 'duration')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Min invest', 'min_invest')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Max invest', 'max_invest')
                ->sortable()
                ->editOnClick()
                ->searchable(),

        ];
    }

    public function onUpdatedEditable($id, $field, $value): void
    {
        Plan::query()->find($id)->update([
            $field => $value,
        ]);
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            Filter::inputText('name')->operators(['contains']),
            Filter::inputText('profit')->operators(['contains']),
            Filter::inputText('duration')->operators(['contains']),
            Filter::boolean('return'),
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
     * PowerGrid Plan Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::make('deactive', 'Deactivate')
                ->class('btn btn-danger btn-sm')
                ->emit('deactive', ['id' => 'id']),

            Button::make('activate', 'Activate')
                ->class('btn btn-primary btn-sm')
                ->emit('activate', ['id' => 'id']),
        ];
    }

    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'deactive'   => 'deactive',
                'activate'   => 'activate',
            ]
        );
    }

    public function deactive($id)
    {
        $user = Plan::find($id['id']);
        $user->status = false;
        $user->save();

        $this->dispatchBrowserEvent('showAlert', ['message' => 'Plan Deactivated Successfully']);
    }

    public function activate($id)
    {
        $user = Plan::find($id['id']);
        $user->status = true;
        $user->save();

        $this->dispatchBrowserEvent('showAlert', ['message' => 'Plan Activated Successfully']);
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Plan Action Rules.
     *
     * @return array<int, RuleActions>
     */


    public function actionRules(): array
    {
        return [

            //Hide button edit for ID 1
            Rule::button('deactive')
                ->when(fn ($plan) => $plan->status == false)
                ->hide(),

            Rule::button('activate')
                ->when(fn ($plan) => $plan->status == true)
                ->hide(),
        ];
    }
}
