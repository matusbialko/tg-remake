<?php
use App\Tasks\Http\Controllers\TaskController;

Route::group(['prefix' => 'api/v1'/* , 'middleware' => 'auth' */], function () {
    Route::get('tasks', [TaskController::class, 'get_tasks']);
    Route::post('task', [TaskController::class, 'post_task']);
});
?>