<?php

namespace App\Domains\Authorization\Jobs;

use App\Data\Models\User;
use Illuminate\Http\Request;
use Lucid\Units\Job;
use Spatie\Permission\Models\Role;

class IndexRoleUsersJob extends Job
{
    private string $role;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($role)
    {
        $this->role = $role;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        $page = $request->query('page');
        $perPage = $request->query('per_page');
        $search = $request->query('search');
        $order = $request->query('order');

        $role = Role::whereName($this->role)->firstOrFail();

        return User::role($role->name)
            ->purifyPaginationQuery($perPage, $page);
    }
}
