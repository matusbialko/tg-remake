<?php namespace App\Tasks\Http\Controllers;

use Exception;
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
        if ($user['id'] !== $project->user_id) throw new Exception('Unauthorized');
        if ($project->is_closed) throw new Exception('Cannot add task to closed project');

        $task = new Task();
        $task->fill($data);
        $task->is_completed = false;
        $user = auth()->user();
        $task->user_id = $user->id;

        $task->save();
        return TaskResource::make($task);
    }
    public function taskUpdate() 
    {
        $data = request()->all();
        Task::findOrFail($data['id']);
        $task = Task::find($data['id']);
        $user = auth()->user();
        if ($user['id'] !== $task->user_id) throw new Exception('Unauthorized');
        $task->name = $data['name'];
        $task->save();
    }
    public function taskComplete() 
    {
        $data = request()->all();
        Task::findOrFail($data['id']);
        $task = Task::find($data['id']);
        $user = auth()->user();
        if ($user['id'] !== $task->user_id) throw new Exception('Unauthorized');
        if ($task->is_completed) {
            $task->is_completed = false;
        } else {
            $task->is_completed = true;
        }
        $task->save();
    }
}