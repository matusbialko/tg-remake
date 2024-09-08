<?php
use App\Entries\Http\Controllers\EntryController;

Route::group(['prefix' => 'api/v1'/* , 'middleware' => 'auth' */], function () {
    Route::get('entries', [EntryController::class, 'entriesIndex']);
    Route::post('entry', [EntryController::class, 'entryCreate']);
    Route::patch('finish_entry', [EntryController::class, 'entryFinish']);
});
?>