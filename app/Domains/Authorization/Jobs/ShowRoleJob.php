<?php

namespace App\Domains\Authorization\Jobs;

use Lucid\Units\Job;
use Spatie\Permission\Models\Role;

class ShowRoleJob extends Job
{
    private int $roleId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $roleId)
    {
        $this->roleId = $roleId;
    }

    /**
     * Execute the job.
     *
     * @return array|mixed[]
     */
    public function handle(): array
    {
        $role = Role::with(['permissions'])->findOrFail($this->roleId)->toArray();

        $role['permissions'] = collect($role['permissions'])->groupBy(function ($permission) {
            return explode('-', $permission['name'])[1];
        });

        return $role;
    }
}
