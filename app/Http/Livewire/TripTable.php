<?php

namespace App\Http\Livewire;

use App\Models\Trip;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class TripTable extends PowerGridComponent
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
    * @return Builder<\App\Models\Trip>
    */
    public function datasource(): Builder
    {
        return Trip::query();
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
            ->addColumn('title_lower', function (Trip $model) {
                return strtolower(e($model->title));
            })

            ->addColumn('location')
            ->addColumn('start_date_formatted', fn (Trip $model) => Carbon::parse($model->start_date)->format('d/m/Y H:i:s'))
            ->addColumn('end_date_formatted', fn (Trip $model) => Carbon::parse($model->end_date)->format('d/m/Y H:i:s'))
            ->addColumn('batch_size')
            ->addColumn('price')
            ->addColumn('created_at_formatted', fn (Trip $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Trip $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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

            Column::make('Title', 'title')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('Location', 'location')
                ->sortable()
                ->searchable(),

            Column::make('Start Date', 'start_date_formatted', 'start_date')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('End Date', 'end_date_formatted', 'end_date')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('Batch Size', 'batch_size')
                ->makeInputRange(),

            Column::make('Price', 'price')
                ->makeInputRange(),

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
     * PowerGrid Trip Action Buttons.
     *
     * @return array<int, Button>
     */

    
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('settings.trips.edit', ['trip' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('settings.trips.delete', ['trip' => 'id'])
               ->method('post')
        ];
    }
    

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Trip Action Rules.
     *
     * @return array<int, RuleActions>
     */

    
    // public function actionRules(): array
    // {
    //    return [

    //        //Hide button edit for ID 1
    //         Rule::button('edit')
    //             ->when(fn($trip) => $trip->id === 1)
    //             ->hide(),
    //     ];
    // }
    
}
