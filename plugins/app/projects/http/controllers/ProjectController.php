<?php namespace App\Projects\Http\Controllers;

use Exception;
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
        $project = new Project();
        $project->fill($data);
        $project->is_closed = false;
        $user = auth()->user();
        $project->user_id = $user->id;
        $project->save();
        return ProjectResource::make($project);
    }
    public function projectUpdate()
    {
        $data = request()->all();
        Project::findOrFail($data['id']);
        $project = Project::find($data['id']);
        $user = auth()->user();
        if ($user['id'] !== $project->user_id) throw new Exception('Unauthorized');
        if ($project->is_closed) throw new Exception('Cannot edit closed project.');
        foreach($data as $key => $value) {
            if ($key != 'id') $project->update([$key => $value]);
        }
        return ProjectResource::make($project);
    }
    public function projectClose()
    {
        $data = request()->all();
        Project::findOrFail($data['id']);
        $project = Project::find($data['id']);
        $user = auth()->user();
        if ($user['id'] !== $project->user_id) throw new Exception('Unauthorized');
        if ($project->is_closed) throw new Exception('Project is already closed.');
        $project->is_closed = true;
        $project->save();
        return ProjectResource::make($project);
    }
}