<?php namespace App\Entries\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateEntriesTable extends Migration
{
    public function up()
    {
        Schema::create('app_entries_entries', function ($table) {
            $table->increments('id');
            $table->string('time_start');
            $table->string('time_end');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('app_entries_entries');
    }
}
