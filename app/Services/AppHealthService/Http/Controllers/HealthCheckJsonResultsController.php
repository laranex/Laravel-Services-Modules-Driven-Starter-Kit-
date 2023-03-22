<?php

namespace App\Services\AppHealthService\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Spatie\Health\Commands\RunHealthChecksCommand;
use Spatie\Health\ResultStores\ResultStore;

class HealthCheckJsonResultsController
{

    /**
     * App HealthCheck JSON
     * @unauthenticated
     * @group HealthCheck
     * 
     * @bodyParam apiKey string required The API Key to get healthCheck status.
     * @bodyParam fresh boolean Fresh the HealthCheck before response.
     */
    public function __invoke(Request $request, ResultStore $resultStore): Response
    {
        $apiKey = $request->get('apiKey');

        if( !$apiKey || $apiKey != config('health.api_key') ) {
            return response(['error' => 'Invalid API Key'], 403)
                    ->header('Content-Type', 'application/json')
                    ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        }

        if ( ($request->has('fresh') && $request->get('fresh')) || config('health.oh_dear_endpoint.always_send_fresh_results')) {
            Artisan::call(RunHealthChecksCommand::class);
        }

        $checkResults = $resultStore->latestResults();

        return response($checkResults?->toJson() ?? '')
            ->header('Content-Type', 'application/json')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    }
}
