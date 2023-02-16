<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->warn('  Creating and super-admin account');
        $user = User::updateOrCreate(['email' => 'superadmin@onenex.co'], ['name' => 'Super Admin', 'password' => 'password']);

        $this->command->warn('  Attaching super-admin role to created user');
        $user->syncRoles([RoleEnum::SUPER_ADMIN->value]);
    }
}
