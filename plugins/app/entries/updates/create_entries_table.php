<?php namespace App\Entries\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use DB;

class CreateEntriesTable extends Migration
{
    public function up()
    {
        Schema::create('app_entries_entries', function ($table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('task_id');
            $table->boolean('isActive');
            $table->string('tracked_time')->default('00:00:00');
            $table->timestamp('time_start')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('time_end')->nullable()->default(null);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('app_entries_entries');
    }
}
