<?php

namespace App\Domains\Authorization\Jobs;

use Illuminate\Http\Request;
use Lucid\Units\Job;
use Spatie\Permission\Models\Permission;

class IndexPermissionJob extends Job
{
    /**
     * Execute the job.
     */
    public function handle(Request $request)
    {
        $page = $request->query('page');
        $perPage = $request->query('per_page');
        $search = $request->query('search');
        $order = $request->query('order');

        $permissionTable = (new Permission)->getTable();

        $searchableFields = ["$permissionTable.id", 'name'];
        $sortableFields = ['id', 'name'];

        $permissions = Permission::select(["$permissionTable.id", 'name', 'guard_name'])
            ->purifySortingQuery($order, $sortableFields)
            ->search($searchableFields, $search)
            ->purifyPaginationQuery($perPage, $page)
            ->toArray();

        if ($page && $perPage) {
            $permissions['data'] = collect($permissions['data'])->groupBy(function ($permission) {
                return explode('-', $permission['name'])[1];
            });
        } else {
            $permissions = collect($permissions)->groupBy(function ($permission) {
                return explode('-', $permission['name'])[1];
            });
        }

        return $permissions;
    }
}
