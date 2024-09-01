<?php
use App\Projects\Http\Controllers\ProjectController;

Route::group(['prefix' => 'api/v1'/* , 'middleware' => 'auth' */], function () {
    Route::get('projects', [ProjectController::class, 'get_projects']);
    Route::post('project', [ProjectController::class, 'post_project']);
    Route::patch('project', [ProjectController::class, 'edit_project']);
    Route::patch('close-project', [ProjectController::class, 'close_project']);
});
?>