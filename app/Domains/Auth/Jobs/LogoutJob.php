<?php

namespace App\Domains\Auth\Jobs;

use Illuminate\Support\Facades\Auth;
use Lucid\Units\Job;

class LogoutJob extends Job
{
    /**
     * Execute the job.
     *
     * @return
     */
    public function handle()
    {
        return Auth::user()->token()->revoke();
    }
}
