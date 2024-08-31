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
        'name'
    ];

    public $rules = [
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
