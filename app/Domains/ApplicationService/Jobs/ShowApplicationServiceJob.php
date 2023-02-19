<?php

namespace App\Domains\ApplicationService\Jobs;

use App\Data\Models\ApplicationService;
use Lucid\Units\Job;

class ShowApplicationServiceJob extends Job
{
    private int $applicationServiceId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $applicationServiceId)
    {
        $this->applicationServiceId = $applicationServiceId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return ApplicationService::findOrFail($this->applicationServiceId);
    }
}
