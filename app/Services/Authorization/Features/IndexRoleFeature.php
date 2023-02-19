<?php

namespace App\Services\Authorization\Features;

use App\Domains\Authorization\Jobs\IndexRoleJob;
use App\Helpers\JsonResponder;
use Illuminate\Http\JsonResponse;
use Lucid\Units\Feature;

class IndexRoleFeature extends Feature
{
    public function handle(): JsonResponse
    {
        $roles = $this->run(new IndexRoleJob());

        return JsonResponder::success('Roles have been retrieved successfully', $roles);
    }
}
