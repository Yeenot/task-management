<?php

namespace App\Core\Services\Tasks;

use App\Models\Task;

class GetTasks
{
    /**
     * Get tasks
     * 
     * @param string $search
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function execute($search = null)
    {
        // Search scope is from a trait: \App\Core\Traits\HasSearch.php
        $tasks = Task::search(['name'], $search)
            ->latest()
            ->get();

        return $tasks;
    }
}