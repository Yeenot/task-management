<?php

namespace App\Core\Services\Tasks;

use App\Models\Task;

class CreateTask
{
    /**
     * Create task
     * 
     * @param array $data
     * @return \App\Models\Task
     */
    public function execute($data)
    {
        $task = Task::create($data);

        return $task;
    }
}