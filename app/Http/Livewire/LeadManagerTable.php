<?php

namespace App\Http\Livewire;

use App\Models\LeadManager;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};
use Spatie\Permission\Models\Role;

final class LeadManagerTable extends PowerGridComponent
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
    * @return Builder<\App\Models\LeadManager>
    */
    public function datasource(): Builder
    {
        if(auth()->user()->hasRole('super-admin')){
            return LeadManager::query()
            ->where('is_lead_manager',1);

        }else if(auth()->user()->hasAnyRole(Role::all())){
            return LeadManager::query()
            ->where('is_lead_manager',1)
            ->where('created_by',auth()->user()->id)
            ->where('authorize_person',auth()->user()->id)

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
            ->addColumn('name')

           /** Example of custom column using a closure **/
            ->addColumn('name_lower', function (LeadManager $model) {
                return strtolower(e($model->name));
            })

            ->addColumn('email')
            ->addColumn('phone_number')
            ->addColumn('lead_source',function(LeadManager $model){
                return User::find($model->id)->leadSource->name;
            })
            ->addColumn('authorize_person',function(LeadManager $model){
                return User::find($model->authorize_person)->name;
            })
            ->addColumn('password')
            ->addColumn('status',function(LeadManager $model){
                return $model->status==1 ? "Active": "Inactive";
            })
            ->addColumn('created_at_formatted', fn (LeadManager $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (LeadManager $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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

            Column::make('Name', 'name','users.name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('Email', 'email','users.email')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('Phone Number', 'phone_number','users.phone_number')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('Lead Source ', 'lead_source'),

            Column::make('Authorize Person', 'authorize_person'),

            Column::make('Status', 'status'),

            Column::make('Created At', 'created_at_formatted', 'users.created_at')
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
     * PowerGrid LeadManager Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        $action = [];
        if(auth()->user()->can('update.lead-managers')){
            array_push($action,  Button::make('edit', 'Edit')
            ->target(' ')
           ->class('bg-indigo-500 cursor-pointer text-white px-2 py-2 m-1 rounded text-sm')
           ->route('lead_managers.edit', ['lead_manager' => 'id']));
        }

        if(auth()->user()->can('delete.lead-managers')){
            array_push($action,  Button::make('destroy', 'Delete')
            ->target(' ')
           ->class('bg-red-500 cursor-pointer text-white px-2 py-2 m-1 rounded text-sm')
           ->route('lead_managers.destroy', ['lead_manager' => 'id'])
           ->method('delete'));
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
     * PowerGrid LeadManager Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($lead-manager) => $lead-manager->id === 1)
                ->hide(),
        ];
    }
    */
}
