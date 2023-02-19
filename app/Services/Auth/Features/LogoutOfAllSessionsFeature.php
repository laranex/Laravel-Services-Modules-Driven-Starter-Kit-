<?php

namespace App\Services\Auth\Features;

use App\Domains\Auth\Jobs\LogoutOfAllSessionsJob;
use App\Helpers\JsonResponder;
use Illuminate\Http\JsonResponse;
use Lucid\Units\Feature;

class LogoutOfAllSessionsFeature extends Feature
{
    public function handle(): JsonResponse
    {
        $this->run(new LogoutOfAllSessionsJob());

        return JsonResponder::success('Logged out of all sessions successfully');
    }
}
