<?php

namespace App\Services\ApplicationService\Features;

use App\Domains\ApplicationService\Jobs\RenewApplicationServiceInCacheJob;
use App\Domains\ApplicationService\Jobs\UpdateApplicationServiceJob;
use App\Domains\ApplicationService\Requests\UpdateApplicationServiceRequest;
use App\Helpers\JsonResponder;
use Lucid\Units\Feature;

class UpdateApplicationServiceFeature extends Feature
{
    public function handle(UpdateApplicationServiceRequest $request): \Illuminate\Http\JsonResponse
    {
        $applicationService = $this->run(new UpdateApplicationServiceJob($request->id, $request->validated()));

        $this->run(RenewApplicationServiceInCacheJob::class);

        return JsonResponder::success('Application Service has been updated successfully', $applicationService);
    }
}
