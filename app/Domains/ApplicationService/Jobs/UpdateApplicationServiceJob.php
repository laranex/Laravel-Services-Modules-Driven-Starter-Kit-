<?php

namespace App\Domains\ApplicationService\Jobs;

use App\Data\Models\ApplicationService;
use Illuminate\Validation\ValidationException;
use Lucid\Units\Job;

class UpdateApplicationServiceJob extends Job
{
    private int $applicationServiceId;

    private array $payload;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $applicationServiceId, array $payload)
    {
        $this->applicationServiceId = $applicationServiceId;
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $applicationService = ApplicationService::findOrFail($this->applicationServiceId);
        if ($applicationService->force_required && $this->payload['active'] == 0) {
            throw ValidationException::withMessages([
                'id' => 'The application service of this id is force required as a core service',
            ]);
        }
        $applicationService->update($this->payload);

        return $applicationService;
    }
}
