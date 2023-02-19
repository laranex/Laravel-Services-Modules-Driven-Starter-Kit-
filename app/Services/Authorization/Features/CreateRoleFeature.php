<?php

namespace App\Services\Authorization\Features;

use App\Domains\Authorization\Jobs\CreateRoleJob;
use App\Domains\Authorization\Requests\CreateRoleRequest;
use App\Helpers\JsonResponder;
use Illuminate\Http\JsonResponse;
use Lucid\Units\Feature;

class CreateRoleFeature extends Feature
{
    public function handle(CreateRoleRequest $request): JsonResponse
    {
        $roles = $this->run(new CreateRoleJob($request->validated()));

        return JsonResponder::success('Role has been created successfully', $roles);
    }
}
