<?php namespace App\Entries\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateEntriesTable extends Migration
{
    public function up()
    {
        Schema::create('app_entries_entries', function ($table) {
            $table->increments('id');
            $table->string('time_from');
            $table->string('time_to');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('app_entries_entries');
    }
}
