<?php

namespace Database\Seeders;

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

        // Create default permissions
        Permission::create(['name' => 'list accomodations']);
        Permission::create(['name' => 'view accomodations']);
        Permission::create(['name' => 'create accomodations']);
        Permission::create(['name' => 'update accomodations']);
        Permission::create(['name' => 'delete accomodations']);

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

        Permission::create(['name' => 'list leadpipelinestages']);
        Permission::create(['name' => 'view leadpipelinestages']);
        Permission::create(['name' => 'create leadpipelinestages']);
        Permission::create(['name' => 'update leadpipelinestages']);
        Permission::create(['name' => 'delete leadpipelinestages']);

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

        Permission::create(['name' => 'list products']);
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

        Permission::create(['name' => 'list transports']);
        Permission::create(['name' => 'view transports']);
        Permission::create(['name' => 'create transports']);
        Permission::create(['name' => 'update transports']);
        Permission::create(['name' => 'delete transports']);

        Permission::create(['name' => 'list trips']);
        Permission::create(['name' => 'view trips']);
        Permission::create(['name' => 'create trips']);
        Permission::create(['name' => 'update trips']);
        Permission::create(['name' => 'delete trips']);

        Permission::create(['name' => 'list triptypes']);
        Permission::create(['name' => 'view triptypes']);
        Permission::create(['name' => 'create triptypes']);
        Permission::create(['name' => 'update triptypes']);
        Permission::create(['name' => 'delete triptypes']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
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

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
