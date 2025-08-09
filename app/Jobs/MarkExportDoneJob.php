<?php

namespace App\Jobs;

use App\Models\ExportTask;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MarkExportDoneJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $taskId) {}

    /**
     * Execute the job.
     */
     public function handle()
    {
        ExportTask::whereKey($this->taskId)->update(['status' => 'done']);
    }
}
