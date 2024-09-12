<?php namespace App\Tasks\Models;

use Model;

/**
 * Task Model
 */
class Task extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'app_tasks_tasks';

    protected $fillable = [
        'id',
        'project_id',
        'name',
        'total_time',
        'isCompleted'
    ];

    public $belongsTo = [
        //'user' => ['RainLab\User\Models\User'],
        'project' => ['App\Projects\Models\Project']
    ];

    public $hasMany = [
        'entries' => ['App\Entries\Models\Entry']
    ];

    public $rules = [
        'project_id' => 'required',
        'name' => 'required|min:1'
    ];

    protected $casts = [];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /* public $belongsTo = [
        'user' => ['RainLab\User\Models\User']
    ]; */
}
