<?php

namespace App\Domains\ApplicationService\Jobs;

use App\Data\Models\ApplicationService;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Data\Models\_IH_ApplicationService_C;
use Lucid\Units\Job;

class IndexApplicationServiceJob extends Job
{
    /**
     * Execute the job.
     *
     * @return Collection|_IH_ApplicationService_C|array
     */
    public function handle(): Collection|_IH_ApplicationService_C|array
    {
        return ApplicationService::all()->sortByDesc('active');
    }
}
