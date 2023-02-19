<?php

namespace App\Domains\Auth\Jobs;

use App\Data\Models\User;
use App\Exceptions\UnauthorizedException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lucid\Units\Job;

class LoginJob extends Job
{
    private string $email;

    private string $password;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return array
     *
     * @throws UnauthorizedException
     */
    public function handle()
    {
        try {
            $user = User::whereEmail($this->email)->firstOrFail();
        } catch (ModelNotFoundException $_) {
            throw new UnauthorizedException('Wrong Credentials');
        }

        if (\Hash::check($this->password, $user->password)) {
            return [
                'access_token' => $user->createToken('Authentication Token')->accessToken,
                'user' => $user->append(['allowed_permissions']),
            ];
        } else {
            throw new UnauthorizedException('Wrong Credentials');
        }
    }
}
