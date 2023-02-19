<?php

namespace App\Services\Authorization\Http\Controllers;

use App\Services\Authorization\Features\IndexPermissionFeature;
use Lucid\Units\Controller;

class PermissionController extends Controller
{
    /**
     *Index Permissions
     *
     * @group Roles and Permissions
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
        return $this->serve(IndexPermissionFeature::class);
    }
}
