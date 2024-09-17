<?php namespace App\Entries\Models;

use Model;
use DateTime;

/**
 * Entry Model
 */
class Entry extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'app_entries_entries';

    protected $fillable = [
        'user_id',
        'time_start',
        'time_end',
        'tracked_time',
        'task_id',
        'isActive'
    ];

    public $rules = [
        'time_start' => 'required',
        'task_id' => 'required'
    ];

    public $belongsTo = [
        'user' => ['RainLab\User\Models\User'],
        'task' => ['App\Tasks\Models\Task']
    ];

    protected $casts = [];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function getTrackedTimeAttribute() {
        if (!isset($this->time_end)) return '00:00:00';
        $start = new DateTime($this->time_start);
        $end = new DateTime($this->time_end);
        $diffObject = $start->diff($end);
        $daysDiff = $diffObject->format('%a');
        return $diffObject->format('%H') + ($daysDiff * 24 ) . ':' . $diffObject->format('%I') . ':' . $diffObject->format('%S');
    }

    public function getIsActiveAttribute() {
        if (isset($this->time_start) && isset($this->time_end)) return false;
        return true;
    }
}
