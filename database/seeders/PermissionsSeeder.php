<?php

namespace Database\Seeders;

use \Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(){
        Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'activities']);
        Permission::create(['name' => 'view.activities']);
        Permission::create(['name' => 'create.activities']);
        Permission::create(['name' => 'store.activities']);
        Permission::create(['name' => 'update.activities']);
        Permission::create(['name' => 'delete.activities']);

        Permission::create(['name' => 'activity-participants']);
        Permission::create(['name' => 'view.activity-participants']);
        Permission::create(['name' => 'create.activity-participants']);
        Permission::create(['name' => 'store.activity-participants']);
        Permission::create(['name' => 'update.activity-participants']);
        Permission::create(['name' => 'delete.activity-participants']);

        Permission::create(['name' => 'email-templates']);
        Permission::create(['name' => 'view.email-templates']);
        Permission::create(['name' => 'create.email-templates']);
        Permission::create(['name' => 'store.email-templates']);
        Permission::create(['name' => 'update.email-templates']);
        Permission::create(['name' => 'delete.email-templates']);

        Permission::create(['name' => 'groups']);
        Permission::create(['name' => 'view.groups']);
        Permission::create(['name' => 'create.groups']);
        Permission::create(['name' => 'store.groups']);
        Permission::create(['name' => 'update.groups']);
        Permission::create(['name' => 'delete.groups']);

        Permission::create(['name' => 'leads']);
        Permission::create(['name' => 'view.leads']);
        Permission::create(['name' => 'create.leads']);
        Permission::create(['name' => 'store.leads']);
        Permission::create(['name' => 'update.leads']);
        Permission::create(['name' => 'delete.leads']);

        Permission::create(['name' => 'lead-managers']);
        Permission::create(['name' => 'view.lead-managers']);
        Permission::create(['name' => 'create.lead-managers']);
        Permission::create(['name' => 'store.lead-managers']);
        Permission::create(['name' => 'update.lead-managers']);
        Permission::create(['name' => 'delete.lead-managers']);

        Permission::create(['name' => 'lead-pipelines']);
        Permission::create(['name' => 'view.lead-pipelines']);
        Permission::create(['name' => 'create.lead-pipelines']);
        Permission::create(['name' => 'store.lead-pipelines']);
        Permission::create(['name' => 'update.lead-pipelines']);
        Permission::create(['name' => 'delete.lead-pipelines']);

        Permission::create(['name' => 'lead-pipeline-stages']);
        Permission::create(['name' => 'view.lead-pipeline-stages']);
        Permission::create(['name' => 'create.lead-pipeline-stages']);
        Permission::create(['name' => 'store.lead-pipeline-stages']);
        Permission::create(['name' => 'update.lead-pipeline-stages']);
        Permission::create(['name' => 'delete.lead-pipeline-stages']);

        Permission::create(['name' => 'lead-products']);
        Permission::create(['name' => 'view.lead-products']);
        Permission::create(['name' => 'create.lead-products']);
        Permission::create(['name' => 'store.lead-products']);
        Permission::create(['name' => 'update.lead-products']);
        Permission::create(['name' => 'delete.lead-products']);

        Permission::create(['name' => 'lead-sources']);
        Permission::create(['name' => 'view.lead-sources']);
        Permission::create(['name' => 'create.lead-sources']);
        Permission::create(['name' => 'store.lead-sources']);
        Permission::create(['name' => 'update.lead-sources']);
        Permission::create(['name' => 'delete.lead-sources']);

        Permission::create(['name' => 'lead-stages']);
        Permission::create(['name' => 'view.lead-stages']);
        Permission::create(['name' => 'create.lead-stages']);
        Permission::create(['name' => 'store.lead-stages']);
        Permission::create(['name' => 'update.lead-stages']);
        Permission::create(['name' => 'delete.lead-stages']);

        Permission::create(['name' => 'lead-types']);
        Permission::create(['name' => 'view.lead-types']);
        Permission::create(['name' => 'create.lead-types']);
        Permission::create(['name' => 'store.lead-types']);
        Permission::create(['name' => 'update.lead-types']);
        Permission::create(['name' => 'delete.lead-types']);

        Permission::create(['name' => 'products']);
        Permission::create(['name' => 'view.products']);
        Permission::create(['name' => 'create.products']);
        Permission::create(['name' => 'store.products']);
        Permission::create(['name' => 'update.products']);
        Permission::create(['name' => 'delete.products']);

        Permission::create(['name' => 'quotations']);
        Permission::create(['name' => 'view.quotations']);
        Permission::create(['name' => 'create.quotations']);
        Permission::create(['name' => 'store.quotations']);
        Permission::create(['name' => 'update.quotations']);
        Permission::create(['name' => 'delete.quotations']);

        Permission::create(['name' => 'quotation-items']);
        Permission::create(['name' => 'view.quotation-items']);
        Permission::create(['name' => 'create.quotation-items']);
        Permission::create(['name' => 'store.quotation-items']);
        Permission::create(['name' => 'update.quotation-items']);
        Permission::create(['name' => 'delete.quotation-items']);

        Permission::create(['name' => 'trips']);
        Permission::create(['name' => 'view.trips']);
        Permission::create(['name' => 'create.trips']);
        Permission::create(['name' => 'store.trips']);
        Permission::create(['name' => 'update.trips']);
        Permission::create(['name' => 'delete.trips']);

        Permission::create(['name' => 'trip-types']);
        Permission::create(['name' => 'view.trip-types']);
        Permission::create(['name' => 'create.trip-types']);
        Permission::create(['name' => 'store.trip-types']);
        Permission::create(['name' => 'update.trip-types']);
        Permission::create(['name' => 'delete.trip-types']);

        Permission::create(['name' => 'accomodations']);
        Permission::create(['name' => 'view.accomodations']);
        Permission::create(['name' => 'create.accomodations']);
        Permission::create(['name' => 'store.accomodations']);
        Permission::create(['name' => 'update.accomodations']);
        Permission::create(['name' => 'delete.accomodations']);

        Permission::create(['name' => 'transports']);
        Permission::create(['name' => 'view.transports']);
        Permission::create(['name' => 'create.transports']);
        Permission::create(['name' => 'store.transports']);
        Permission::create(['name' => 'update.transports']);
        Permission::create(['name' => 'delete.transports']);

        Permission::create(['name' => 'roles']);
        Permission::create(['name' => 'view.roles']);
        Permission::create(['name' => 'create.roles']);
        Permission::create(['name' => 'store.roles']);
        Permission::create(['name' => 'update.roles']);
        Permission::create(['name' => 'delete.roles']);

        Permission::create(['name' => 'permissions']);
        Permission::create(['name' => 'view.permissions']);
        Permission::create(['name' => 'create.permissions']);
        Permission::create(['name' => 'store.permissions']);
        Permission::create(['name' => 'update.permissions']);
        Permission::create(['name' => 'delete.permissions']);

        Permission::create(['name' => 'users']);
        Permission::create(['name' => 'view.users']);
        Permission::create(['name' => 'create.users']);
        Permission::create(['name' => 'store.users']);
        Permission::create(['name' => 'update.users']);
        Permission::create(['name' => 'delete.users']);


        $permissions = Permission::all();
        $super_admin = Role::create(['name' => 'super-admin']);
        $super_admin->givePermissionTo($permissions);

        $user = User::create([
            'name'=>'Super Admin',
            'email'=>'super-admin@thrillblazers.in',
            'phone_number'=>"911234567891",
            'is_existing'=>1,
            'is_admin'=>1,
            'is_manager'=>0,
            'is_lead_manager'=>0,
            // 'authorize_person'=>1,
            'lead_source_id'=>1,
            'email_verified_at'=>now(),
            'password'=>\Hash::make('password'),
            'status'=>'1',
            'remember_token'=>Str::random(10)
        ]);

        $user->assignRole($super_admin);

        //Manager

        $manager = Role::create(['name'=>'manager']);
        $manageruser = User::create([
            'name'=>'Manager',
            'email'=>'manager@thrillblazers.in',
            'phone_number'=>"911234567891",
            'is_existing'=>1,
            'is_admin'=>0,
            'is_manager'=>1,
            'is_lead_manager'=>0,
            'authorize_person'=>1,
            'lead_source_id'=>2,
            'email_verified_at'=>now(),
            'password'=>\Hash::make('password'),
            'status'=>'1',
            'remember_token'=>Str::random(10)
        ]);
        $managerpermission = Permission::whereNotIn(
            'name',[
                'activities',
                'view.activities',
                'create.activities',
                'store.activities',
                'update.activities',
                'delete.activities',
                 'activity-participants',
                 'view.activity-participants',
                 'create.activity-participants',
                 'store.activity-participants',
                 'update.activity-participants',
                 'delete.activity-participants',
                 'products',
                 'view.products',
                 'create.products',
                 'store.products',
                 'update.products',
                 'delete.products',
                 'lead-sources',
                 'view.lead-sources',
                 'create.lead-sources',
                 'store.lead-sources',
                 'update.lead-sources',
                 'delete.lead-stages',
                 'roles',
                 'view.roles',
                 'create.roles',
                 'store.roles',
                 'update.roles',
                 'delete.roles',
                ])->get();

                $manager->givePermissionTo($managerpermission);
                $manageruser->assignRole($manager);


                //Lead Manager

                $leadmanager = Role::create(['name'=>'lead-manager']);
                $leadmanageruser = User::create([
                    'name'=>'Lead Manager',
                    'email'=>'lead_manager@thrillblazers.in',
                    'phone_number'=>"911234567891",
                    'is_existing'=>1,
                    'is_admin'=>0,
                    'is_manager'=>0,
                    'is_lead_manager'=>1,
                    'authorize_person'=>2,
                    'lead_source_id'=>2,
                    'email_verified_at'=>now(),
                    'password'=>\Hash::make('password'),
                    'status'=>'1',
                    'remember_token'=>Str::random(10),
                ]);

                $leadmangerpermission = Permission::whereIn(
                    'name', [
                        'activities',
                        'view.activities',
                        'create.activities',
                        'store.activities',
                        'update.activities',
                        'delete.activities',
                        'activity-participants',
                        'view.activity-participants',
                        'create.activity-participants',
                        'store.activity-participants',
                        'update.activity-participants',
                        'delete.activity-participants',
                        'quotations',
                        'view.quotations',
                        'create.quotations',
                        'store.quotations',
                        'update.quotations',
                        'delete.quotations',
                        'quotation items',
                        'view.quotation items',
                        'create.quotation items',
                        'store.quotation items',
                        'update.quotation items',
                        'delete.quotation items',
                        'trip',
                        'view.trip',
                        'create.trip',
                        'store.trip',
                        'update.trip',
                        'delete.trip'
                    ]
                )->get();

                $leadmanager->givePermissionTo($leadmangerpermission);
                $leadmanageruser->assignRole($leadmanager);
                Permission::create(['name' => 'mails']);
                Permission::create(['name' => 'compose.mails']);
                Permission::create(['name' => 'sent.mails']);
                Permission::create(['name' => 'draft.mails']);
                Permission::create(['name' => 'update.mails']);
                Permission::create(['name' => 'restore.mails']);
                Permission::create(['name' => 'forceDelete.mails']);
                Permission::create(['name' => 'trash.mails']);
                Permission::create(['name' => 'delete.mails']);

    }
}
