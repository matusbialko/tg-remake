<?php namespace App\Projects\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Projects\Models\Project;
use App\Projects\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    public function projectsIndex()
    {
        $projects = Project::where('user_id', auth()->user()->id)->get();
        return ProjectResource::collection($projects);
    }
    public function projectCreate()
    {
        $data = request()->all();
        $data['isClosed'] = false;
        $user = auth()->user();
        $data['user_id'] = $user->id;

        $project = Project::create($data);
        return new ProjectResource($project);
    }
    public function projectUpdate()
    {
        $data = request()->all();
        Project::findOrFail($data['id']);
        $project = Project::find($data['id']);
        $user = auth()->user();
        if ($user['id'] !== $project['user_id']) die('Unauthorized');
        if ($project['isClosed']) die('Cannot edit closed project.');
        foreach($data as $key => $value) {
            if ($key != 'id') 
                Project::find($data['id'])->update([$key => $value]);
        }
        return new ProjectResource(Project::find($data['id']));
    }
    public function projectClose()
    {
        $data = request()->all();
        Project::findOrFail($data['id']);
        $project = Project::find($data['id']);
        $user = auth()->user();
        if ($user['id'] !== $project['user_id']) die('Unauthorized');
        if ($project['isClosed']) die('Project is already closed.');
        Project::find($data['id'])->update(['isClosed' => true]);
        return new ProjectResource(Project::find($data['id']));
    }
}