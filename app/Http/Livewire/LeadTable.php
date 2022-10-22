<?php

namespace App\Http\Livewire;

use App\Models\Lead;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class LeadTable extends PowerGridComponent
{
    use ActionButton;

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
    * @return Builder<\App\Models\Lead>
    */
    public function datasource(): Builder
    {
        return Lead::query();
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
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('title')

           /** Example of custom column using a closure **/
            ->addColumn('title_lower', function (Lead $model) {
                return strtolower(e($model->title));
            })

            ->addColumn('description')
            ->addColumn('lead_value')
            ->addColumn('status')
            ->addColumn('lost_reason')
            ->addColumn('traveler_count')
            ->addColumn('selected_trip_date_formatted', fn (Lead $model) => Carbon::parse($model->selected_trip_date)->format('d/m/Y'))
            ->addColumn('closed_at_formatted', fn (Lead $model) => Carbon::parse($model->closed_at)->format('d/m/Y H:i:s'))
            ->addColumn('user_id')
            ->addColumn('lead_manager_id')
            ->addColumn('lead_source_id')
            ->addColumn('lead_type_id')
            ->addColumn('lead_pipeline_id')
            ->addColumn('lead_pipeline_stage_id')
            ->addColumn('trip_id')
            ->addColumn('trip_type_id')
            ->addColumn('accomodation_id')
            ->addColumn('transport_id')
            ->addColumn('expected_closed_date_formatted', fn (Lead $model) => Carbon::parse($model->expected_closed_date)->format('d/m/Y'))
            ->addColumn('created_at_formatted', fn (Lead $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Lead $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
            Column::make('ID', 'id')
                ->makeInputRange(),

            Column::make('TITLE', 'title')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('DESCRIPTION', 'description')
                ->sortable()
                ->searchable(),

            Column::make('LEAD VALUE', 'lead_value')
                ->makeInputRange(),

            Column::make('STATUS', 'status')
                ->toggleable(),

            Column::make('LOST REASON', 'lost_reason')
                ->sortable()
                ->searchable(),

            Column::make('TRAVELER COUNT', 'traveler_count')
                ->makeInputRange(),

            Column::make('SELECTED TRIP DATE', 'selected_trip_date_formatted', 'selected_trip_date')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('CLOSED AT', 'closed_at_formatted', 'closed_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('USER ID', 'user_id')
                ->makeInputRange(),

            Column::make('LEAD MANAGER ID', 'lead_manager_id')
                ->makeInputRange(),

            Column::make('LEAD SOURCE ID', 'lead_source_id')
                ->makeInputRange(),

            Column::make('LEAD TYPE ID', 'lead_type_id')
                ->makeInputRange(),

            Column::make('LEAD PIPELINE ID', 'lead_pipeline_id')
                ->makeInputRange(),

            Column::make('LEAD PIPELINE STAGE ID', 'lead_pipeline_stage_id')
                ->makeInputRange(),

            Column::make('TRIP ID', 'trip_id')
                ->makeInputRange(),

            Column::make('TRIP TYPE ID', 'trip_type_id')
                ->makeInputRange(),

            Column::make('ACCOMODATION ID', 'accomodation_id')
                ->makeInputRange(),

            Column::make('TRANSPORT ID', 'transport_id')
                ->makeInputRange(),

            Column::make('EXPECTED CLOSED DATE', 'expected_closed_date_formatted', 'expected_closed_date')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Lead Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('lead.edit', ['lead' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('lead.destroy', ['lead' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Lead Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($lead) => $lead->id === 1)
                ->hide(),
        ];
    }
    */
}
