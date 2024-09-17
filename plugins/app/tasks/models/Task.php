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
        'user_id',
        'project_id',
        'name',
        'total_time',
        'isCompleted'
    ];

    public $belongsTo = [
        'user' => ['RainLab\User\Models\User'],
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

    public function getTotalTimeAttribute() {
        $totalSeconds = 0;
        for ($i = 0; $i < count($this->entries); $i++) {
            list($hours, $minutes, $seconds) = explode(":", $this->entries[$i]['tracked_time']);
            $timeInSeconds = ($hours * 3600) + ($minutes * 60) + $seconds;
            $totalSeconds += $timeInSeconds;
        }
        return gmdate("H:i:s", $totalSeconds);
    }
}
