<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{

    
    /**
     * Get all tasks.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Task::orderBy('created_at', 'desc')->get());
    }
    
    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return void
     */
    public function create(Request $request): void
    {
        Task::create($request->all());
    }
    
    /**
     * Update a task.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());

    }
    
    /**
     * Delete a task.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }
    
}
