<?php

namespace App\Listeners;

use App\Events\QueueDataInserted;
use App\Events\QueueEmpty;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessQueueData
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }


    public function handle(QueueDataInserted $event)
    {
        // Process the queue data
        $data = $event->queueData;
        // ...

        // Check if the queue is empty (this will depend on your queue driver)
        if ($this->isQueueEmpty()) {
            // Dispatch an event to signal that the queue is empty
            event(new QueueEmpty());
        }
    }

    protected function isQueueEmpty()
    {
        // Implement logic to check if the queue is empty
        // This will depend on your queue driver
        // For example, for the database driver, you can check if there are any pending jobs in the jobs table.
        return \DB::table('jobs')->count() === 0;
    }
}
