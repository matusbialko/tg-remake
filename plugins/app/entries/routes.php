<?php
use App\Entries\Http\Controllers\EntryController;

Route::group(['prefix' => 'api/v1'/* , 'middleware' => 'auth' */], function () {
    Route::get('entries', [EntryController::class, 'get_entries']);
    Route::post('entry', [EntryController::class, 'post_entry']);
});
?>