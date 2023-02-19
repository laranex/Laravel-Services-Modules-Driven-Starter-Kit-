<?php

namespace App\Services\Authorization\Features;

use App\Domains\Authorization\Jobs\UpdateRoleJob;
use App\Domains\Authorization\Requests\UpdateRoleRequest;
use App\Helpers\JsonResponder;
use Illuminate\Http\JsonResponse;
use Lucid\Units\Feature;

class UpdateRoleFeature extends Feature
{
    public function handle(UpdateRoleRequest $request): JsonResponse
    {
        $role = $this->run(new UpdateRoleJob($request->id, $request->validated()));

        return JsonResponder::success('Role has been successfully updated', $role);
    }
}
