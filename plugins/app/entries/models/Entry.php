<?php namespace App\Entries\Models;

use Model;

/**
 * Entry Model
 */
class Entry extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'app_entries_entries';

    protected $fillable = [
        'id',
        'time_start',
        'time_end',
        'task_id',
        'isActive'
    ];

    public $rules = [
        'time_start' => 'required',
        'task_id' => 'required',
        'isActive' => 'required'
    ];

    public $belongsTo = [
        //'user' => ['RainLab\User\Models\User'],
        'task' => ['App\Tasks\Models\Task']
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
