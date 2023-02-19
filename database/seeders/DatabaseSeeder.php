<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*if (config('core.lucid_application_providers')) {
            $this->call(ApplicationServiceSeeder::class);
        }*/

        $this->call([
            PermissionAndRoleSeeder::class,
            SuperAdminSeeder::class,
        ]);

        //User::factory(100)->create();
    }
}
