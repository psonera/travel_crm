<?php

namespace App\Http\Livewire;

use App\Models\Country;
use App\Models\Quotation;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class QuotationTable extends PowerGridComponent
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
    * @return Builder<\App\Models\Quotation>
    */
    public function datasource(): Builder
    {
        return Quotation::query();
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
            ->addColumn('subject')

           /** Example of custom column using a closure **/
            ->addColumn('subject_lower', function (Quotation $model) {
                return strtolower(e($model->subject));
            })

            ->addColumn('description')
            ->addColumn('billing_address',function(Quotation $model){
                $json_address = json_decode($model->billing_address);
                $address = $json_address->address." , ".$json_address->city_name.",".$json_address->postcode.",".$json_address->state_name.",".$json_address->country_name;
                return $address;
            })
            ->addColumn('shipping_address',function(Quotation $model){
                $json_address = json_decode($model->shipping_address);
                $address = $json_address->address." , ".$json_address->city_name.",".$json_address->postcode.",".$json_address->state_name.",".$json_address->country_name;
                return $address;
            })
            ->addColumn('discount_percent')
            ->addColumn('discount_amount')
            ->addColumn('tax_amount')
            ->addColumn('sub_total')
            ->addColumn('grand_total')
            ->addColumn('lead_manager_id',function(Quotation $model){
                if($model->leadManager==null){
                    return "null";
                }
                return $model->leadManager->name;
            })
            ->addColumn('user_id',function(Quotation $model){
                if($model->user==null){
                    return "null";
                }
                return $model->user->name;
            })
            ->addColumn('lead_id',function(Quotation $model){
                if($model->lead==null){
                    return "null";
                }
                return $model->lead->title;
            })
            ->addColumn('created_at_formatted', fn (Quotation $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Quotation $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
            Column::make('ID', 'id'),

            Column::make('SUBJECT', 'subject'),

            Column::make('DESCRIPTION', 'description'),

            Column::make('BILLING ADDRESS', 'billing_address'),
            Column::make('SHIPPING ADDRESS', 'shipping_address'),

            Column::make('DISCOUNT PERCENT', 'discount_percent')
                ->sortable()
                ->searchable(),

            Column::make('DISCOUNT AMOUNT', 'discount_amount')
                ->makeInputRange(),

            Column::make('TAX AMOUNT', 'tax_amount')
                ->makeInputRange(),
            Column::make('SUB TOTAL', 'sub_total')
                ->makeInputRange(),
            Column::make('GRAND TOTAL', 'grand_total')
                ->makeInputRange(),
            Column::make('LEAD MANAGER ', 'lead_manager_id'),
            Column::make('MANAGER ', 'user_id'),
            Column::make('LEAD ', 'lead_id'),
            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->searchable()
                ->makeInputDatePicker(),

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
     * PowerGrid Quotation Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('quotations.edit', ['id' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('quotations.delete', ['id' => 'id'])
               ->method('delete')
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
     * PowerGrid Quotation Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($quotation) => $quotation->id === 1)
                ->hide(),
        ];
    }
    */
}