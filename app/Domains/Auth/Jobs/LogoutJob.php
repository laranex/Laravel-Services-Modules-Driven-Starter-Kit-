<?php

namespace App\Domains\Auth\Jobs;

use Illuminate\Support\Facades\Auth;
use Lucid\Units\Job;

class LogoutJob extends Job
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Auth::user()->token()->revoke();
    }
}
