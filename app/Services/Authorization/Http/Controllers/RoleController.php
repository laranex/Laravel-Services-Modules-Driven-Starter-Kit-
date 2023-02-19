<?php

namespace App\Services\Authorization\Http\Controllers;

use App\Services\Authorization\Features\CreateRoleFeature;
use App\Services\Authorization\Features\DeleteRoleFeature;
use App\Services\Authorization\Features\IndexRoleFeature;
use App\Services\Authorization\Features\ShowRoleFeature;
use App\Services\Authorization\Features\UpdateRoleFeature;
use Lucid\Units\Controller;

class RoleController extends Controller
{
    /**
     * Index Roles
     *
     * @group Permissions & Roles
     *
     * @queryParam page integer The page for pagination
     * @queryParam per_page integer The number of result for a paginated page
     * @queryParam search string Keyword to search
     *
     * The results can be sorted by adding the query parameter as follows.
     * ?order[0][column]=name&order[0][order]=desc
     */
    public function index()
    {
        return $this->serve(IndexRoleFeature::class);
    }

    /**
     * Create A Role
     *
     * @group Permissions & Roles
     *
     * @bodyParam name string required name of the Role
     * @bodyParam permission_ids array required Ids of the permissions
     */
    public function create()
    {
        return $this->serve(CreateRoleFeature::class);
    }

    /**
     * Show A Role
     *
     * @group Permissions & Roles
     *
     * @urlParam id integer required Unique id of the Role
     */
    public function show()
    {
        return $this->serve(ShowRoleFeature::class);
    }

    /**
     * Update A Role
     *
     * @group Permissions & Roles
     *
     * @urlParam id integer required ID of the Role
     * @bodyParam name string required name of the Role
     * @bodyParam permission_ids array required Ids of the permissions
     */
    public function update()
    {
        return $this->serve(UpdateRoleFeature::class);
    }

    /**
     * Delete a Role
     *
     * @group Permissions & Roles
     *
     * @urlParam id integer required id of the Role
     */
    public function destroy()
    {
        return $this->serve(DeleteRoleFeature::class);
    }
}
