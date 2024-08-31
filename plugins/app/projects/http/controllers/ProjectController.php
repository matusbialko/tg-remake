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
        //$user = auth()->user();
        //$data['name'] = $user->name;
        //$data['user_id'] = $user->id;
        $project = Project::create($data);
        return new ProjectResource($project);
    }
}