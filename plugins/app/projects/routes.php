<?php
use App\Projects\Http\Controllers\ProjectController;

Route::group(['prefix' => 'api/v1'/* , 'middleware' => 'auth' */], function () {
    Route::get('projects', [ProjectController::class, 'projectsIndex']);
    Route::post('project', [ProjectController::class, 'projectCreate']);
    Route::patch('project', [ProjectController::class, 'projectUpdate']);
    Route::patch('close-project', [ProjectController::class, 'projectClose']);
});
?>