<?php namespace App\Tasks\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Tasks\Models\Task;
use App\Tasks\Http\Resources\TaskResource;
use App\Projects\Models\Project;

class TaskController extends Controller
{
    public function tasksIndex()
    {
        //$tasks = Task::where('user_id', auth()->user()->id)->get();
        return TaskResource::collection(Task::all());
    }
    public function taskCreate()
    {
        $data = request()->all();
        Project::findOrFail($data['project_id']);
        $project = Project::where('id', $data['project_id'])->get();
        if ($project[0]['isClosed']) die('Cannot add task to closed project');

        $data['isCompleted'] = false;
        //$user = auth()->user();
        //$data['name'] = $user->name;
        //$data['user_id'] = $user->id;
        
        $data['id'] = count(Task::all());
        $task = Task::create($data);
        return new TaskResource($task);
    }
    public function taskUpdate() 
    {
        $data = request()->all();
        Task::findOrFail($data['id']);
        Task::where('id', $data['id'])->update(['name' => $data['name']]);
    }
    public function taskComplete() 
    {
        $data = request()->all();
        Task::findOrFail($data['id']);
        $task = Task::where('id', $data['id'])->get();
        if ($task[0]['isCompleted']) {
            Task::where('id', $data['id'])->update(['isCompleted' => false]);
        } else {
            Task::where('id', $data['id'])->update(['isCompleted' => true]);
        }
    }
}