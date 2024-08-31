<?php namespace App\Tasks\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Tasks\Models\Task;
use App\Tasks\Http\Resources\TaskResource;

class TaskController extends Controller
{
    public function get_tasks()
    {
        //$tasks = Task::where('user_id', auth()->user()->id)->get();
        return TaskResource::collection(Task::all());
    }
    public function post_task()
    {
        $data = request()->all();
        //$user = auth()->user();
        //$data['name'] = $user->name;
        //$data['user_id'] = $user->id;
        $task = Task::create($data);
        return new TaskResource($task);
    }
}