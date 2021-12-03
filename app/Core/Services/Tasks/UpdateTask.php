<?php

namespace App\Core\Services\Tasks;

use App\Models\Task;

class UpdateTask
{
    /**
     * Update task
     * 
     * @param int $id
     * @param array $data
     * @return \App\Models\Task
     */
    public function execute($id, $data)
    {
        $task = Task::find($id);
        $task->update($data);

        return $task;
    }
}