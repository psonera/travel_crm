<?php

namespace App\Http\Livewire;

use App\Models\Email;
use Illuminate\Support\Str;
use Illuminate\Routing\Route;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class EmailTable extends PowerGridComponent
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
    * @return Builder<\App\Models\Email>
    */
    public function datasource(): Builder
    {   
        $roles = Role::where('name','!=','super-admin')->get();
        if(request()->is('mails')){
            if(auth()->user()->is_admin==1){
                return Email::query()->where('status',1);
            }
            if(auth()->user()->hasAnyRole($roles)){
                return Email::query()->where('status',1)->where('from',auth()->user()->email);
            }
        }
        if(request()->is('mails/sent')){
            if(auth()->user()->is_admin==1){
                return Email::query()->where('status',1);
            }
            if(auth()->user()->hasAnyRole($roles)){
                return Email::query()->where('status',1)->where('from',auth()->user()->email);
            }
        }
        if(request()->is('mails/draft')){
            if(auth()->user()->is_admin==1){
                return Email::query()->where('status',2);
            }
            if(auth()->user()->hasAnyRole($roles)){
                return Email::query()->where('status',2)->where('from',auth()->user()->email);
            }

        }
        if(request()->is('mails/trash')){
            if(auth()->user()->is_admin==1){
                return Email::query()->onlyTrashed();
            }
            if(auth()->user()->hasAnyRole($roles)){
                return Email::query()->onlyTrashed()->where('from',auth()->user()->email);
            }

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
            ->addColumn('to')

           /** Example of custom column using a closure **/
            ->addColumn('to_lower', function (Email $model) {
                return strtolower(e($model->to));
            })

            ->addColumn('from')
            ->addColumn('cc')
            ->addColumn('bcc')
            ->addColumn('subject')
            ->addColumn('content',function(Email $model){
                return Str::limit(html_entity_decode($model->content), 20, '...');
            })
            ->addColumn('status',function(Email $email){
                if($email->status==1){
                    return "sent";
                }else if($email->status==2){
                    return "draft";
                }

            })
            ->addColumn('created_at_formatted', fn (Email $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Email $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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

            Column::make('To', 'to')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('From', 'from')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('Cc', 'cc')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('Bcc', 'bcc')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('Subject', 'subject')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('Content', 'content')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status'),

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
     * PowerGrid Email Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {

        $sent = [
            Button::make('destroy', 'Move To Trash')
            ->target('')
            ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            ->route('mails.destroy', ['id' => 'id'])
            ->method('get')
        ];
        $draft = [
            Button::make('sent', 'Sent')
            ->target('')
            ->class('bg-green-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            ->route('mails.sendDraft', ['id' => 'id'])
            ->method('get'),
            Button::make('edit', 'Edit')
            ->target('')
            ->class('bg-yellow-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            ->route('mails.editdraft', ['email' => 'id'])
            ->method('get'),
            Button::make('restore', 'Move To Trash')
            ->target('')
            ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            ->route('mails.destroy', ['id' => 'id'])
            ->method('get'),
        ];
        $trash = [
            Button::make('restore', 'Restore')
            ->target('')
            ->class('bg-green-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            ->route('mails.restore', ['id' => 'id'])
            ->method('get'),
            Button::make('destroy', 'Delete')
            ->target('')
            ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            ->route('mails.forceDelete', ['id' => 'id'])
            ->method('post')
        ];

        if(request()->is('mails')){
            return $sent;
        }
        if(request()->is('mails/sent')){
            return $sent;
        }
        if(request()->is('mails/draft')){
            return $draft;
        }
        if(request()->is('mails/trash')){
            return $trash;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Email Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($email) => $email->id === 1)
                ->hide(),
        ];
    }
    */
}
