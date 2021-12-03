<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    private $items = [
        [
            'id' => 1,
            'name' => "Setup project on localhost",
            'status' => 'done'
        ],
        [
            'id' => 2,
            'name' => "Create table named tasks",
            'status' => 'done'
        ],
        [
            'id' => 3,
            'name' => "Create task seeder",
            'status' => 'in_progress'
        ],
        [
            'id' => 4,
            'name' => "Fix bug/issue on tasks table",
            'status' => 'open'
        ],
        [
            'id' => 5,
            'name' => "Implement create new task",
            'status' => 'open'
        ],
        [
            'id' => 6,
            'name' => "Implement update task",
            'status' => 'open'
        ],
        [
            'id' => 7,
            'name' => "Allow delete of task",
            'status' => 'open'
        ],
        [
            'id' => 8,
            'name' => "Add search functionality",
            'status' => 'open'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->truncate();
        foreach($this->items as $item) {
            Task::create($item);
        }
    }
}