<?php

namespace App\Services\Authorization\Features;

use App\Domains\Authorization\Jobs\ShowRoleJob;
use App\Helpers\JsonResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lucid\Units\Feature;

class ShowRoleFeature extends Feature
{
    public function handle(Request $request): JsonResponse
    {
        $role = $this->run(new ShowRoleJob($request->id));

        return JsonResponder::success('Role has been retrieved successfully', $role);
    }
}
