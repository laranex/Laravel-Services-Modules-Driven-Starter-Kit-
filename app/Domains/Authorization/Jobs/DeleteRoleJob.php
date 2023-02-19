<?php

namespace App\Domains\Authorization\Jobs;

use Lucid\Units\Job;
use Spatie\Permission\Models\Role;

class DeleteRoleJob extends Job
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
     *
     * @throws \Exception
     */
    public function handle(): bool
    {
        return Role::findOrFail($this->roleId)->delete();
    }
}
