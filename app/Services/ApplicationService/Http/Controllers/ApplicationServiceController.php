<?php

namespace App\Services\ApplicationService\Http\Controllers;

use App\Services\ApplicationService\Features\IndexApplicationServiceFeature;
use App\Services\ApplicationService\Features\ShowApplicationServiceFeature;
use App\Services\ApplicationService\Features\UpdateApplicationServiceFeature;
use Lucid\Units\Controller;

class ApplicationServiceController extends Controller
{
    /**
     * Index Application Services
     *
     * @group ApplicationService
     */
    public function index()
    {
        return $this->serve(IndexApplicationServiceFeature::class);
    }

    /**
     * Show Application Service
     *
     * @group ApplicationService
     *
     * @urlParam id integer required The id of the Application Service.
     */
    public function show()
    {
        return $this->serve(ShowApplicationServiceFeature::class);
    }

    /**
     * Update Application Service
     *
     * @group ApplicationService
     *
     * @urlParam id integer required The id of the Application Service.
     * @bodyParam active boolean optional The active status of the Application Service.
     * @bodyParam description string optional The description of the Application Service.
     */
    public function update()
    {
        return $this->serve(UpdateApplicationServiceFeature::class);
    }
}
