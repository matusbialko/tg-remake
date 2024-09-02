<?php namespace App\Projects\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Projects\Models\Project;
use App\Projects\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    public function get_projects()
    {
        //$projects = Project::where('user_id', auth()->user()->id)->get();
        return ProjectResource::collection(Project::all());
    }
    public function post_project()
    {
        $data = request()->all();
        $data['isClosed'] = false;
        //$user = auth()->user();
        //$data['name'] = $user->name;
        //$data['user_id'] = $user->id;
        
        $data['id'] = count(Project::all());
        $project = Project::create($data);
        return new ProjectResource($project);
    }
    public function edit_project() 
    {
        $data = request()->all();
        Project::findOrFail($data['id']);
        $project = Project::where('id', $data['id'])->get();
        if ($project[0]['isClosed']) die('Cannot edit closed project.');
        Project::where('id', $data['id'])->update(['name' => $data['name']]);
    }
    public function close_project() 
    {
        $data = request()->all();
        Project::findOrFail($data['id']);
        $project = Project::where('id', $data['id'])->get();
        if ($project[0]['isClosed']) die('Project is already closed.');
        Project::where('id', $data['id'])->update(['isClosed' => true]);
    }
}