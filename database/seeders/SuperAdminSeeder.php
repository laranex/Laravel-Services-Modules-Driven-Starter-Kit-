<?php

namespace Database\Seeders;

use App\Data\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;

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
