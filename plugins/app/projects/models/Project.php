<?php namespace App\Projects\Models;

use Model;

/**
 * Project Model
 */
class Project extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'app_projects_projects';

    protected $fillable = [
        'user_id',
        'name',
        'isClosed',
        'customer',
        'projectManager',
        'list'
    ];

    public $belongsTo = [
        'user' => ['RainLab\User\Models\User']
    ];

    public $hasMany = [
        'tasks' => ['App\Tasks\Models\Task']
    ];

    public $rules = [
        'name' => 'required|min:1',
        'customer' => 'required|min:1',
        'projectManager' => 'required|min:1',
        'list' => 'required|min:1'
    ];

    protected $casts = [];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
