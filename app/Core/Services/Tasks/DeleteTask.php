<?php

namespace App\Core\Services\Tasks;

use App\Models\Task;

class DeleteTask
{
    /**
     * Delete task
     * 
     * @param int $id
     * @return void
     */
    public function execute($id)
    {
        $task = Task::find($id);
        $task->delete();
    }
}