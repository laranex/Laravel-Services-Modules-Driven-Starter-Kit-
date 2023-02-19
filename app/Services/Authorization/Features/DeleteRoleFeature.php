<?php

namespace App\Services\Authorization\Features;

use App\Domains\Authorization\Jobs\DeleteRoleJob;
use App\Helpers\JsonResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lucid\Units\Feature;

class DeleteRoleFeature extends Feature
{
    public function handle(Request $request): JsonResponse
    {
        $role = $this->run(new DeleteRoleJob($request->id));

        return JsonResponder::success('Role has been deleted successfully', $role);
    }
}
