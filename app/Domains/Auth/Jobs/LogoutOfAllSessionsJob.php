<?php

namespace App\Domains\Auth\Jobs;

use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Token;
use Lucid\Units\Job;

class LogoutOfAllSessionsJob extends Job
{
    /**
     * Execute the job.
     */
    public function handle(): bool
    {
        return Token::where('user_id', Auth::id())->update(['revoked' => true]);
    }
}
