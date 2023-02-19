<?php

namespace App\Domains\Authorization\Jobs;

use Exception;
use Illuminate\Support\Facades\DB;
use Lucid\Units\Job;
use Spatie\Permission\Models\Role;

class UpdateRoleJob extends Job
{
    private array $payload;

    private int $roleId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $roleId, array $payload)
    {
        $this->roleId = $roleId;
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
            $role = Role::findOrFail($this->roleId);
            $role->syncPermissions($payload->get('permission_ids'));
            $role->update(['name' => $payload->get('name')]);

            DB::commit();

            return $role;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
