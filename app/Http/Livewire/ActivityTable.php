<?php

namespace App\Http\Livewire;

use App\Models\Activity;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class ActivityTable extends PowerGridComponent
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
    * @return Builder<\App\Models\Activity>
    */
    public function datasource(): Builder
    {
        return Activity::query();
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
            ->addColumn('title_lower', function (Activity $model) {
                return strtolower(e($model->title));
            })

            ->addColumn('type')
            ->addColumn('comment')
            ->addColumn('schedule_from_formatted', fn (Activity $model) => Carbon::parse($model->schedule_from)->format('d/m/Y H:i:s'))
            ->addColumn('schedule_to_formatted', fn (Activity $model) => Carbon::parse($model->schedule_to)->format('d/m/Y H:i:s'))
            ->addColumn('is_done',function(Activity $model){
                return $model->is_done==0 ? "No": "Yes";
            })
            ->addColumn('user_id',function(Activity $model){
                if($model->user_id==null){
                    return null;
                }else{
                    return $model->user->name;
                }

            })
            ->addColumn('location')
            ->addColumn('created_at_formatted', fn (Activity $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Activity $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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

            Column::make('Type', 'type')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('Comment', 'comment')
                ->sortable()
                ->searchable(),

            Column::make('Schedule from', 'schedule_from_formatted', 'schedule_from')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('Schedule to', 'schedule_to_formatted', 'schedule_to')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('Is Done', 'is_done'),

            Column::make('User Id', 'user_id'),

            Column::make('Location', 'location')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('Created At', 'created_at_formatted', 'created_at')
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
     * PowerGrid Activity Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        $action = [];
        if(auth()->user()->can('update.activities')){
            array_push($action,  Button::make('edit', 'Edit')
            ->target('')
           ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
           ->route('activities.edit', ['activity' => 'id']));
        }
        if(auth()->user()->can('delete.activities')){
            array_push($action,  Button::make('destroy', 'Delete')
            ->target('')
           ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
           ->route('activities.delete', ['id' => 'id'])
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
     * PowerGrid Activity Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($activity) => $activity->id === 1)
                ->hide(),
        ];
    }
    */
}
