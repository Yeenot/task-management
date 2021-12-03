<?php

namespace App\Http\Controllers\Tasks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Core\Services\Tasks\GetTasks;
use App\Core\Services\Tasks\CreateTask;
use App\Core\Services\Tasks\GetTask;
use App\Core\Services\Tasks\UpdateTask;
use App\Core\Services\Tasks\DeleteTask;
use App\Http\Requests\Tasks\TaskListRequest;
use App\Http\Requests\Tasks\TaskStoreRequest;
use App\Http\Requests\Tasks\TaskUpdateRequest;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * \App\Core\Services\Tasks\GetTasks $getTasks
     * @return \Illuminate\Http\Response
     */
    public function index(TaskListRequest $request, GetTasks $getTasks)
    {
        $search = $request->query('search');
        $tasks = $getTasks->execute($search);

        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Tasks\TaskStoreRequest $request
     * @param  \App\Core\Services\Tasks\CreateTask $createTask
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStoreRequest $request, CreateTask $createTask)
    {
        $data = $request->validated();
        $createTask->execute($data);

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Core\Services\Tasks\GetTask $getTask
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(GetTask $getTask, $id)
    {
        $task = $getTask->execute($id);
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Tasks\TaskUpdateRequest $request
     * @param  \App\Core\Services\Tasks\UpdateTask $updateTask
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request, UpdateTask $updateTask, $id)
    {
        $data = $request->validated();
        $updateTask->execute($id, $data);

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\Tasks\DeleteTask $deleteTask
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteTask $deleteTask, $id)
    {
        $deleteTask->execute($id);
        return response()->noContent();
    }
}
