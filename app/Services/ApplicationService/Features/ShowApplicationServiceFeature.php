<?php

namespace App\Services\ApplicationService\Features;

use App\Domains\ApplicationService\Jobs\ShowApplicationServiceJob;
use App\Helpers\JsonResponder;
use Illuminate\Http\Request;
use Lucid\Units\Feature;

class ShowApplicationServiceFeature extends Feature
{
    public function handle(Request $request): \Illuminate\Http\JsonResponse
    {
        $applicationService = $this->run(new ShowApplicationServiceJob($request->id));

        return JsonResponder::success('Application Service has been retrieved successfully', $applicationService);
    }
}
