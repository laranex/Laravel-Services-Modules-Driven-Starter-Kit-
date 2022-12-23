<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function run()
    {
        // Wipe the tables used for authorization
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            collect(config('permission.table_names'))
                ->except(['model_has_roles'])
                ->values()
                ->each(fn($table) => DB::table($table)->truncate());

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } catch (\Exception $exception) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            throw $exception;
        }


        $guard = config('auth.defaults.guard');

        //Seeding Roles
        collect(config('core.roles'))
            ->map(fn($role) => ['name' => $role, 'guard_name' => $guard])
            ->pipe(fn($roles) => Role::insertOrIgnore($roles->toArray()));

        //Seeding Permissions
        collect(config('core.permissions'))
            ->map(fn($permission) => ['name' => $permission, 'guard_name' => $guard])
            ->pipe(fn($permissions) => Permission::insertOrIgnore($permissions->toArray()));

        $role = Role::where('name', RoleEnum::SUPER_ADMIN->value)->firstOrFail();
        $role->syncPermissions(Permission::all());

        Role::whereName(RoleEnum::SCSC_MEMBER->value)->firstOrFail()->givePermissionTo([
            PermissionEnum::MANAGE_SCSC_PROFILE->value,
        ]);
    }
}
