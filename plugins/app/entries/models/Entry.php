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
        'time_from',
        'time_to'
    ];

    public $rules = [
        'time_from' => 'required',
        'time_to' => 'required'
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
