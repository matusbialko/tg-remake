<?php
use App\Tasks\Http\Controllers\TaskController;

Route::group(['prefix' => 'api/v1'/* , 'middleware' => 'auth' */], function () {
    Route::get('tasks', [TaskController::class, 'get_tasks']);
    Route::post('task', [TaskController::class, 'post_task']);
    Route::patch('task', [TaskController::class, 'edit_task']);
    Route::patch('switch_complete_task', [TaskController::class, 'switch_complete_task']);
});
?>