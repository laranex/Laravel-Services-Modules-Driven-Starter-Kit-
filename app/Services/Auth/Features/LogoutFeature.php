<?php

namespace App\Services\Auth\Features;

use App\Domains\Auth\Jobs\LogoutJob;
use App\Helpers\JsonResponder;
use Illuminate\Http\JsonResponse;
use Lucid\Units\Feature;

class LogoutFeature extends Feature
{
    public function handle(): JsonResponse
    {
        $this->run(new LogoutJob());

        return JsonResponder::success('Logged out successfully');
    }
}
