<?php namespace App\Projects;

use Backend;
use System\Classes\PluginBase;
use RainLab\User\Models\User;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'Projects',
            'description' => 'No description provided yet...',
            'author'      => 'App',
            'icon'        => 'icon-leaf'
        ];
    }

    public function boot()
    {
        User::extend(function($model){
            $model->hasMany['project'] = ['App\Projects\Models\Project'];
        });
    }

    public function registerPermissions()
    {
        return [
            'app.projects.projects' => [
                'tab' => 'Projects',
                'label' => 'Projects'
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'projects' => [
                'label'       => 'Projects',
                'url'         => Backend::url('app/projects/projects'),
                'icon'        => 'icon-leaf',
                'permissions' => ['app.projects.*'],
                'order'       => 500,
            ],
        ];
    }
}
