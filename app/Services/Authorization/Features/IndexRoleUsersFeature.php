<?php

namespace App\Services\Authorization\Features;

use App\Domains\Authorization\Jobs\IndexRoleUsersJob;
use App\Helpers\JsonResponder;
use Lucid\Units\Feature;

class IndexRoleUsersFeature extends Feature
{
    private string $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function handle()
    {
        $users = $this->run(IndexRoleUsersJob::class, ['role' => $this->role]);

        return JsonResponder::success('Role Users has been retrieved successfully', $users);
    }
}
