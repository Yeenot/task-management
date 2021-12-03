<?php

namespace App\Core\Services\Tasks;

use App\Models\Task;

class GetTask
{
    /**
     * Get task
     * 
     * @param int $id
     * @return \App\Models\Task
     */
    public function execute($id)
    {
        $task = Task::find($id);

        return $task;
    }
}