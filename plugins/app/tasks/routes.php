<?php
use App\Tasks\Http\Controllers\TaskController;

Route::group(['prefix' => 'api/v1'/* , 'middleware' => 'auth' */], function () {
    Route::get('tasks', [TaskController::class, 'tasksIndex']);
    Route::post('task', [TaskController::class, 'taskCreate']);
    Route::patch('task', [TaskController::class, 'taskUpdate']);
    Route::patch('switch_complete_task', [TaskController::class, 'taskComplete']);
});
?>