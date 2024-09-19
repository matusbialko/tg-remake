<?php namespace App\Tasks\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Tasks\Models\Task;
use App\Tasks\Http\Resources\TaskResource;
use App\Projects\Models\Project;

class TaskController extends Controller
{
    public function tasksIndex()
    {
        $tasks = Task::where('user_id', auth()->user()->id)->get();
        return TaskResource::collection($tasks);
    }
    public function taskCreate()
    {
        $data = request()->all();
        Project::findOrFail($data['project_id']);
        $project = Project::find($data['project_id']);
        $user = auth()->user();
        if ($user['id'] !== $project->user_id) die('Unauthorized');
        if ($project->isClosed) die('Cannot add task to closed project');

        $task = new Task();
        $task->fill($data);
        $task->isCompleted = false;
        $user = auth()->user();
        $task->user_id = $user->id;

        $task->save();
        return new TaskResource($task);
    }
    public function taskUpdate() 
    {
        $data = request()->all();
        Task::findOrFail($data['id']);
        $task = Task::find($data['id']);
        $user = auth()->user();
        if ($user['id'] !== $task->user_id) die('Unauthorized');
        $task->name = $data['name'];
        $task->save();
    }
    public function taskComplete() 
    {
        $data = request()->all();
        Task::findOrFail($data['id']);
        $task = Task::find($data['id']);
        $user = auth()->user();
        if ($user['id'] !== $task->user_id) die('Unauthorized');
        if ($task->isCompleted) {
            $task->isCompleted = false;
        } else {
            $task->isCompleted = true;
        }
        $task->save();
    }
}