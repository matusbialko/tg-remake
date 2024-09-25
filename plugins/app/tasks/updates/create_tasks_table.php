<?php namespace App\Tasks\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('app_tasks_tasks', function ($table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('project_id');
            $table->string('name');
            $table->boolean('is_completed');
            $table->string('total_time')->default('00:00:00');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('app_tasks_tasks');
    }
}
