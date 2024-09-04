<?php namespace App\Entries;

use Backend;
use System\Classes\PluginBase;
//use RainLab\User\Models\User;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'Entries',
            'description' => 'No description provided yet...',
            'author'      => 'App',
            'icon'        => 'icon-leaf'
        ];
    }

    public function boot()
    {
        /* User::extend(function($model){
            $model->hasMany['project'] = ['App\Projects\Models\Project'];
        }); */
    }

    public function registerPermissions()
    {
        return [
            'app.entries.entries' => [
                'tab' => 'Entries',
                'label' => 'Entries'
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'entries' => [
                'label'       => 'Entries',
                'url'         => Backend::url('app/entries/entries'),
                'icon'        => 'icon-leaf',
                'permissions' => ['app.entries.*'],
                'order'       => 500,
            ],
        ];
    }
}
