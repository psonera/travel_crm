<?php

namespace App\Http\Livewire;

use App\Models\Lead;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
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
        if(auth()->user()->hasRole('super-admin')){
            return Lead::query();
        }else if(auth()->user()->hasAnyRole(Role::all())){
            return Lead::query()
            ->where('created_by',auth()->user()->id)
            ->orWhere('user_id',auth()->user()->id)
            ->orWhere('lead_manager_id',auth()->user()->id);
            ;
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

            ->addColumn('description', fn (Lead $model) => \Str::limit($model->description, 12, $end='...'))
            ->addColumn('lead_value')
            ->addColumn('status', fn (Lead $model) => ($model->status == 1) ? 'Active' : 'Inactive')
            ->addColumn('traveler_count')
            ->addColumn('selected_trip_date_formatted', fn (Lead $model) => Carbon::parse($model->selected_trip_date)->format('d/m/Y'))
            ->addColumn('closed_at_formatted', fn (Lead $model) => Carbon::parse($model->closed_at)->format('d/m/Y H:i:s'))
            ->addColumn('user_id', fn (Lead $model) => $model->user->name)
            ->addColumn('lead_manager_id', fn (Lead $model) => $model->leadManager->name)
            ->addColumn('lead_source_id', fn (Lead $model) => $model->leadSource->name)
            ->addColumn('lead_type_id', fn (Lead $model) => $model->leadType->name)
            ->addColumn('lead_pipeline_stage_id', fn (Lead $model) => $model->leadPipelineStage->name)
            ->addColumn('trip_id', fn (Lead $model) => \Str::limit($model->trip->title, 12, $end='...'))
            ->addColumn('trip_type_id', fn (Lead $model) => $model->tripType->name)
            ->addColumn('accomodation_id', fn (Lead $model) => $model->accomodation->name)
            ->addColumn('transport_id', fn (Lead $model) => $model->transport->name)
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
            Column::make('Id', 'id')
                ->makeInputRange(),

            Column::make('Title', 'title')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('Description', 'description')
                ->sortable()
                ->searchable(),

            Column::make('Lead Value', 'lead_value')
                ->makeInputRange(),

            Column::make('Status', 'status'),

            Column::make('Traveler Count', 'traveler_count')
                ->makeInputRange(),

            Column::make('Selected Trip Date', 'selected_trip_date_formatted', 'selected_trip_date')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('Closed At', 'closed_at_formatted', 'closed_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('Manager', 'user_id'),

            Column::make('Lead Manager', 'lead_manager_id'),

            Column::make('Source', 'lead_source_id'),

            Column::make('Type', 'lead_type_id'),

            Column::make('Stage', 'lead_pipeline_stage_id'),

            Column::make('Trip', 'trip_id'),

            Column::make('Trip Type', 'trip_type_id'),

            Column::make('Accomodation', 'accomodation_id'),

            Column::make('Transport', 'transport_id'),

            Column::make('Expected Closed Date', 'expected_closed_date_formatted', 'expected_closed_date')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('Updated at', 'updated_at_formatted', 'updated_at')
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

    public function actions(): array
    {
        $action = [];

        if(auth()->user()->can('update.leads')){
           array_push($action, Button::make('edit', 'Edit')
           ->target('')
           ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
           ->route('leads.edit', ['lead' => 'id']));
        }

        if(auth()->user()->can('delete.leads')){
            array_push($action, Button::make('destroy', 'Delete')
            ->target('')
            ->method('post')
            ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            ->route('leads.delete', ['lead' => 'id']));
        }
       return $action;
    }

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
