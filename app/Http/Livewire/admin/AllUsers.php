<?php

namespace App\Http\Livewire\admin;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class AllUsers extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    public $name;
    public $email;
    public $username;
    public $authenticator_code;

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
     * @return Builder<\App\Models\User>
     */
    public function datasource(): Builder
    {
        return User::query();
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
            ->addColumn('name_lower', fn (User $model) => strtolower(e($model->name)))
            ->addColumn('balance', fn (User $model) => number_format($model->getBalance(), 2))

            ->addColumn('email')
            ->addColumn('username')
            ->addColumn('role')
            ->addColumn('status')
            ->addColumn('kyc_status')
            ->addColumn('refer')
            ->addColumn('authenticator')
            ->addColumn('authenticator_code')
            ->addColumn('created_at_formatted', fn (User $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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
            Column::make('Name', 'name')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Username', 'username')
                ->sortable()
                ->searchable(),

            Column::make('Role', 'role')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Kyc status', 'kyc_status')
                ->sortable()
                ->searchable(),

            Column::make('Refer', 'refer')
                ->sortable()
                ->searchable(),
                Column::make('BALANCE', 'balance'),

            Column::make('Authenticator', 'authenticator')
                ->toggleable(),

            Column::make('Authenticator code', 'authenticator_code')
                ->sortable()
                ->editOnClick()
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
            Filter::inputText('name')->operators(['contains']),
            Filter::inputText('email')->operators(['contains']),
            Filter::inputText('username')->operators(['contains']),
            Filter::inputText('role')->operators(['contains']),
            Filter::inputText('status')->operators(['contains']),
            Filter::inputText('kyc_status')->operators(['contains']),
            Filter::inputText('refer')->operators(['contains']),
            Filter::boolean('authenticator'),
            Filter::inputText('authenticator_code')->operators(['contains']),
            Filter::datetimepicker('created_at'),
        ];
    }

    public function onUpdatedEditable($id, $field, $value): void
    {
        User::query()->find($id)->update([
            $field => $value,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid User Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            //    Button::make('edit', 'Edit')
            //        ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
            //        ->route('user.edit', function(\App\Models\User $model) {
            //             return $model->id;
            //        }),

            //    Button::make('destroy', 'Delete')
            //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            //        ->route('user.destroy', function(\App\Models\User $model) {
            //             return $model->id;
            //        })
            //        ->method('delete')

            Button::make('suspend', 'Suspend')
                ->class('btn btn-danger btn-sm')
                ->emit('suspend', ['id' => 'id']),

            Button::make('activate', 'Activate')
                ->class('btn btn-danger btn-sm')
                ->emit('activate', ['id' => 'id']),

            Button::make('login', 'LOGIN')
                ->class('btn btn-success btn-sm')
                ->emit('login', ['id' => 'id']),
        ];
    }


    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'suspend'   => 'suspend',
                'activate'   => 'activate',
                'login'   => 'login',
            ]
        );
    }

    public function suspend($id)
    {
        $user = User::find($id['id']);
        $user->status = 'suspend';
        $user->save();

        $this->dispatchBrowserEvent('showAlert', ['message' => 'User Suspended Successfully']);
    }

    public function activate($id)
    {
        $user = User::find($id['id']);
        $user->status = 'active';
        $user->save();

        $this->dispatchBrowserEvent('showAlert', ['message' => 'User Active Successfully']);
    }

    public function login($id)
    {
        $user = User::find($id['id']);
        session(['hashed_password' => $user->password]);

        Auth::login($user);

        return redirect()->route('user.dashboard.index');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid User Action Rules.
     *
     * @return array<int, RuleActions>
     */


    public function actionRules(): array
    {
        return [

            Rule::button('suspend')
                ->when(fn ($user) => $user->status == 'suspend')
                ->hide(),

            Rule::button('activate')
                ->when(fn ($user) => $user->status == 'active')
                ->hide(),
        ];
    }
}
