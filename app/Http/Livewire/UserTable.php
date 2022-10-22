<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class UserTable extends PowerGridComponent
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

    public function datasource(): Builder
    {
        if(auth()->user()->hasRole('super-admin')){
            return User::query()
            ->where('users.id','!=',auth()->user()->id);
        }else{
            return User::query()->where('authorize_person',auth()->user()->id);
        }
    }


    public function relationSearch(): array
    {
        return [];
    }


    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('name')

           /** Example of custom column using a closure **/
            ->addColumn('name_lower', function (User $model) {
                return strtolower(e($model->name));
            })

            ->addColumn('email')
            ->addColumn('phone_number')
            ->addColumn('status',function(User $model){
                return $model->status==1 ? "Active": "Inactive";
            })
            ->addColumn('is_admin', function (User $model) {
                 if($model->is_admin==1){
                    return "YES";
                 }else{
                    return "No";
                 }
              })

            ->addColumn('is_manager', function (User $model) {
                if($model->is_manager==1){
                   return "YES";
                }else{
                   return "No";
                }
             })

            ->addColumn('is_lead_manager', function (User $model) {
                if($model->is_lead_manager==1){
                   return "YES";
                }else{
                   return "No";
                }
             })
            ->addColumn('lead_source_id',function(User $model){
                return $model->leadSource->name;
            })
            ->addColumn('authorize_person',function(User $model){
                if(User::find($model->authorize_person)==null){
                    return "null";
                }
                return User::find($model->authorize_person)->name;
            })
            ->addColumn('created_at_formatted', fn (User $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
            // ->addColumn('updated_at_formatted', fn (User $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
    }


    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),
            Column::make('NAME', 'name','users.name')
                ->sortable()
                ->searchable()
                ->makeInputText(),
            Column::make('EMAIL', 'email','users.email')
                ->sortable()
                ->searchable()
                ->makeInputText(),
            Column::make('PHONE NUMBER', 'phone_number','users.phone_number')
                ->sortable()
                ->searchable()
                ->makeInputText(),
            Column::make('STATUS', 'status'),
            Column::make('IS ADMIN', 'is_admin'),
            Column::make('IS MANAGER', 'is_manager' ),
            Column::make('IS LEAD MANAGER', 'is_lead_manager'),
            Column::make('LEAD SOURCE ID', 'lead_source_id'),
            Column::make('AUTHORIZE PERSON', 'authorize_person','auth_person.authorize_person')
                ->searchable()
                ->makeInputText(),
            Column::make('CREATED AT', 'created_at_formatted', 'users.created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),
        ];
    }



    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
                ->target('')
                ->class('bg-indigo-500 cursor-pointer text-white px-2 py-2 m-1 rounded text-sm')
                ->route('settings.users.edit', ['user' => 'id']),

           Button::make('destroy', 'Delete')
               ->target('')
               ->class('bg-red-500 cursor-pointer text-white px-2 py-2 m-1 rounded text-sm')
               ->route('settings.users.destroy', ['user' => 'id'])
               ->method('get')
        ];
    }
}
