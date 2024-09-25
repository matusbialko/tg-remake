<?php namespace App\Tasks;

use Backend;
use System\Classes\PluginBase;
use RainLab\User\Models\User;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'Tasks',
            'description' => 'No description provided yet...',
            'author'      => 'App',
            'icon'        => 'icon-leaf'
        ];
    }

    public function boot()
    {
        User::extend(function($model){
            $model->hasMany['projects'] = ['App\Projects\Models\Project'];
        });
    }

    public function registerPermissions()
    {
        return [
            'app.tasks.tasks' => [
                'tab' => 'Tasks',
                'label' => 'Tasks'
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'tasks' => [
                'label'       => 'Tasks',
                'url'         => Backend::url('app/tasks/tasks'),
                'icon'        => 'icon-leaf',
                'permissions' => ['app.tasks.*'],
                'order'       => 500,
            ],
        ];
    }
}
