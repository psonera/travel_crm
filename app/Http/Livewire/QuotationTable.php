<?php

namespace App\Http\Livewire;

use App\Models\Quotation;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
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
        if(auth()->user()->hasRole('super-admin')){
            return Quotation::query();
        }else if(auth()->user()->hasAnyRole(Role::all())){
            return Quotation::query()
            ->where('created_by',auth()->user()->id)
            ->orWhere('user_id',auth()->user()->id)
            ->orWhere('lead_manager_id',auth()->user()->id);
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
            ->addColumn('subject')
            ->addColumn('description')
            ->addColumn('billing_address',function(Quotation $model){
                $json_address = json_decode($model->billing_address);
                $address = $json_address->address." , ".$json_address->city_name.",".$json_address->postcode.",".$json_address->state_name.",".$json_address->country_name;
                return Str::limit($address, 12, '...') ;
            })
            ->addColumn('shipping_address',function(Quotation $model){
                $json_address = json_decode($model->shipping_address);
                $address = $json_address->address." , ".$json_address->city_name.",".$json_address->postcode.",".$json_address->state_name.",".$json_address->country_name;
                return Str::limit($address, 12, '...') ;
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
            Column::make('Id', 'id')
                ->makeInputRange(),

            Column::make('Subject', 'subject'),

            Column::make('Description', 'description'),

            Column::make('Billing Address', 'billing_address'),

            Column::make('Shipping Address', 'shipping_address'),

            Column::make('Discount Percent', 'discount_percent')
                ->sortable()
                ->searchable(),

            Column::make('Discount Amount', 'discount_amount')
                ->makeInputRange(),

            Column::make('Tax Amount', 'tax_amount')
                ->makeInputRange(),

            Column::make('Sub Total', 'sub_total')
                ->makeInputRange(),

            Column::make('Grand Total', 'grand_total')
                ->makeInputRange(),
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
     * PowerGrid Quotation Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {

        $action = [];
        if(auth()->user()->can('update.quotations')){
            array_push($action, Button::make('edit', 'Edit')
            ->target('')
           ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
           ->route('quotations.edit', ['id' => 'id']));
       }
       if(auth()->user()->can('delete.quotations')){
            array_push($action, Button::make('destroy', 'Delete')
            ->target('')
           ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
           ->route('quotations.delete', ['id' => 'id'])
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
     * PowerGrid Quotation Action Rules.
     *
     * @return array<int, RuleActions>
     */


    // public function actionRules(): array
    // {
    //     dump( auth()->user()->can('update.quotations'));
    //     dump( auth()->user()->can('delete.quotations'));

    //    return [

    //        //Hide button edit for ID 1
    //         Rule::button('edit')
    //             // ->when(!in_array('edit.quotations',auth()->user()->roles[0]->permission))
    //             ->when(fn()=>auth()->user()->can('edit.quotations')==false)
    //             ->hide(),
    //         Rule::button('destroy')
    //         // ->when(!in_array('edit.quotations',auth()->user()->roles[0]->permission))
    //         ->when(fn()=>auth()->user()->can('delete.quotations')==false)
    //         ->hide(),
    //     ];
    // }

}
