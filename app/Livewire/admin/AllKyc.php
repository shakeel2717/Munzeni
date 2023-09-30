<?php

namespace App\Livewire\admin;

use App\Models\Kyc;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class AllKyc extends PowerGridComponent
{
    use WithExport;

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
        return Kyc::query()
            ->where('status', false);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('user_id')
            ->addColumn('front')

            ->addColumn('front_image', function (Kyc $model) {
                return "<img  width='100' src='" . asset('kyc/' . $model->front) . "' alt='front' />";
            })

            ->addColumn('back_image', function (Kyc $model) {
                return "<img width='100' src='" . asset('kyc/' . $model->back) . "' alt='back' />";
            })
            ->addColumn('status')
            ->addColumn('created_at_formatted', fn (Kyc $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('User id', 'user_id'),
            Column::make('Front', 'front_image', 'back')
                ->sortable()
                ->searchable(),

            Column::make('Back', 'back_image', 'back')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->toggleable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('front')->operators(['contains']),
            Filter::inputText('back')->operators(['contains']),
            Filter::boolean('status'),
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('approve')]
    public function approve($rowId): void
    {
        $kyc = Kyc::find($rowId);
        $kyc->status = true;
        $kyc->save();

        $user = $kyc->user;
        $user->kyc_status = 'approved';
        $user->save();
        $this->dispatch('showAlert', ['message' => 'Kyc Approved Successfully!']);
    }

    public function actions(\App\Models\Kyc $row): array
    {
        return [
            Button::add('approve')
                ->slot('Approve')
                ->class('btn btn-success btn-sm')
                ->dispatch('approve', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
