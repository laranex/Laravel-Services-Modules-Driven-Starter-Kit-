<?php

namespace App\Domains\Authorization\Jobs;

use Illuminate\Http\Request;
use Lucid\Units\Job;
use Spatie\Permission\Models\Role;

class IndexRoleJob extends Job
{
    public function handle(Request $request): array
    {
        $page = $request->query('page');
        $perPage = $request->query('per_page');
        $search = $request->query('search');
        $order = $request->query('order');

        $roleTable = (new Role)->getTable();

        $searchableFields = ["$roleTable.id", 'name'];
        $sortableFields = ['id', 'name'];

        $roles = Role::with('permissions')->select(["$roleTable.id", 'name', 'guard_name'])
            ->purifySortingQuery($order, $sortableFields)
            ->search($searchableFields, $search)
            ->purifyPaginationQuery($perPage, $page)
            ->toArray();

        if ($perPage && $page) {
            $roles['data'] = collect($roles['data'])->map(function ($role) {
                $role['permissions'] = collect($role['permissions'])
                    ->groupBy(function ($permission) {
                        return explode('-', $permission['name'])[1];
                    });

                return $role;
            });
        } else {
            $roles = collect($roles)->map(function ($role) {
                $role['permissions'] = collect($role['permissions'])
                    ->groupBy(function ($permission) {
                        return explode('-', $permission['name'])[1];
                    });

                return $role;
            })->toArray();
        }

        return $roles;
    }
}
