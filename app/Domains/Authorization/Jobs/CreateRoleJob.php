<?php

namespace App\Domains\Authorization\Jobs;

use Exception;
use Illuminate\Support\Facades\DB;
use Lucid\Units\Job;
use Spatie\Permission\Models\Role;

class CreateRoleJob extends Job
{
    private array $payload;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     *
     * @return Role
     *
     * @throws Exception
     */
    public function handle(): Role
    {
        $payload = collect($this->payload);

        DB::beginTransaction();

        try {
            $role = Role::create([
                'name' => $payload->get('name'),
                'guard_name' => 'api',
            ]);

            $role->syncPermissions($payload->get('permission_ids'));

            DB::commit();

            return $role;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
