<?php

namespace App\Domains\Auth\Jobs;

use Lucid\Units\Job;

class LogoutJob extends Job
{
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return \Auth::user()->token()->revoke();
    }
}
