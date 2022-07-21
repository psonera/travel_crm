<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    #region Permission

        Permission::create(['name' => 'list activities']);
        Permission::create(['name' => 'view activities']);
        Permission::create(['name' => 'create activities']);
        Permission::create(['name' => 'update activities']);
        Permission::create(['name' => 'delete activities']);

        Permission::create(['name' => 'list activityparticipants']);
        Permission::create(['name' => 'view activityparticipants']);
        Permission::create(['name' => 'create activityparticipants']);
        Permission::create(['name' => 'update activityparticipants']);
        Permission::create(['name' => 'delete activityparticipants']);

        Permission::create(['name' => 'list emailtemplates']);
        Permission::create(['name' => 'view emailtemplates']);
        Permission::create(['name' => 'create emailtemplates']);
        Permission::create(['name' => 'update emailtemplates']);
        Permission::create(['name' => 'delete emailtemplates']);

        Permission::create(['name' => 'list groups']);
        Permission::create(['name' => 'view groups']);
        Permission::create(['name' => 'create groups']);
        Permission::create(['name' => 'update groups']);
        Permission::create(['name' => 'delete groups']);

        Permission::create(['name' => 'list leads']);
        Permission::create(['name' => 'view leads']);
        Permission::create(['name' => 'create leads']);
        Permission::create(['name' => 'update leads']);
        Permission::create(['name' => 'delete leads']);

        Permission::create(['name' => 'list leadmanagers']);
        Permission::create(['name' => 'view leadmanagers']);
        Permission::create(['name' => 'create leadmanagers']);
        Permission::create(['name' => 'update leadmanagers']);
        Permission::create(['name' => 'delete leadmanagers']);

        Permission::create(['name' => 'list leadpipelines']);
        Permission::create(['name' => 'view leadpipelines']);
        Permission::create(['name' => 'create leadpipelines']);
        Permission::create(['name' => 'update leadpipelines']);
        Permission::create(['name' => 'delete leadpipelines']);

        Permission::create(['name' => 'list leadpiplelinestages']);
        Permission::create(['name' => 'view leadpiplelinestages']);
        Permission::create(['name' => 'create leadpiplelinestages']);
        Permission::create(['name' => 'update leadpiplelinestages']);
        Permission::create(['name' => 'delete leadpiplelinestages']);

        Permission::create(['name' => 'list leadproducts']);
        Permission::create(['name' => 'view leadproducts']);
        Permission::create(['name' => 'create leadproducts']);
        Permission::create(['name' => 'update leadproducts']);
        Permission::create(['name' => 'delete leadproducts']);

        Permission::create(['name' => 'list leadsources']);
        Permission::create(['name' => 'view leadsources']);
        Permission::create(['name' => 'create leadsources']);
        Permission::create(['name' => 'update leadsources']);
        Permission::create(['name' => 'delete leadsources']);

        Permission::create(['name' => 'list leadstages']);
        Permission::create(['name' => 'view leadstages']);
        Permission::create(['name' => 'create leadstages']);
        Permission::create(['name' => 'update leadstages']);
        Permission::create(['name' => 'delete leadstages']);

        Permission::create(['name' => 'list leadtypes']);
        Permission::create(['name' => 'view leadtypes']);
        Permission::create(['name' => 'create leadtypes']);
        Permission::create(['name' => 'update leadtypes']);
        Permission::create(['name' => 'delete leadtypes']);

        Permission::create(['name' => 'list products']);  //product
        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'update products']);
        Permission::create(['name' => 'delete products']);

        Permission::create(['name' => 'list quotations']);
        Permission::create(['name' => 'view quotations']);
        Permission::create(['name' => 'create quotations']);
        Permission::create(['name' => 'update quotations']);
        Permission::create(['name' => 'delete quotations']);

        Permission::create(['name' => 'list quotationitems']);
        Permission::create(['name' => 'view quotationitems']);
        Permission::create(['name' => 'create quotationitems']);
        Permission::create(['name' => 'update quotationitems']);
        Permission::create(['name' => 'delete quotationitems']);

        Permission::create(['name' => 'list treks']);
        Permission::create(['name' => 'view treks']);
        Permission::create(['name' => 'create treks']);
        Permission::create(['name' => 'update treks']);
        Permission::create(['name' => 'delete treks']);


        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        #endregion Permission
    #region assignrolesandpermission
        #region superadmin
        $superadminpermission = Permission::all();
        $adminRole = Role::create(['name' => 'Super Admin']);
        $adminRole->givePermissionTo($superadminpermission);

        $user = User::create(
            [
                'name' => "Superadmin",
                'email'=>'superadmin@example.com',
                'email_verified_at'=>now(),
                'password'=>'password',
                'status'=>'1',
                'remember_token'=>Str::random(10)
            ]
        );
         $user->assignRole($adminRole);
         #endregion superadmin
        #region LeadManager
            //Lead Manger Rights

                $pemission = Permission::whereIn(

                        'name',['view leads','update leads','list leads
                        ','view leads','list quotations','view quotations','create quotations','update quotations','delete quotations','list quotationitems','view quotationitems','create quotationitems','update quotationitems','delete quotationitems','list activities','view activities','create activities','update activities','delete activities','list activityparticipants','view activityparticipants','create activityparticipants','update activityparticipants','delete activityparticipants','list treks','view treks','create treks']

                )->get();
            //end Lead Manager Rights
            $adminRole = Role::create(['name' => 'Lead Manager']);
            $adminRole->givePermissionTo($pemission);

            $user = User::create(
                [
                    'name' => "Lead Manager",
                    'email'=>'leadmanager@example.com',
                    'email_verified_at'=>now(),
                    'password'=>'password',
                    'status'=>'1',
                    'remember_token'=>Str::random(10)
                ]
            );
            $user->assignRole($adminRole);
        #endregion LeadManager
        #region Manager(admin)
            $permisson = Permission::whereNotIn(
                'name',[
                    'list quotations','
                    view quotations',
                    'create quotations',
                    'update quotations',
                    'delete quotations',
                    'list quotationitems',
                    'view quotationitems',
                    'create quotationitems',
                    'update quotationitems',
                    'delete quotationitems',
                    'list activities',
                    'view activities',
                    'create activities',
                    'update activities',
                    'delete activities',
                    'list activityparticipants',
                    'view activityparticipants',
                    'create activityparticipants',
                    'update activityparticipants',
                    'delete activityparticipants',
                    'list groups',
                    'view groups',
                    'create groups',
                    'update groups',
                    'delete groups',
                    'list leadproducts',
                    'view leadproducts',
                    'create leadproducts',
                    'update leadproducts',
                    'delete leadproducts',
                    'list leadstages',
                    'view leadstages',
                    'create leadstages',
                    'update leadstages',
                    'delete leadstages',
                    'list roles',
                    'view roles',
                    'create roles',
                    'update roles',
                    'delete roles',
                    'list permissions',
                    'view permissions',
                    'create permissions',
                    'update permissions',
                    'delete permissions',
                ]
            )->get();

            $adminRole = Role::create(['name' => 'Manager']);
            $adminRole->givePermissionTo($permisson);
            $user = User::create(
                [
                    'name' => "Manager",
                    'email'=>'manager@example.com',
                    'email_verified_at'=>now(),
                    'password'=>'password',
                    'status'=>'1',
                    'remember_token'=>Str::random(10)
                ]
            );
            $user->assignRole($adminRole);
         #endregion LeadManager
    #endregion assignrolesandpermission
    }
}
