<?php namespace App\Projects\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('app_projects_projects', function ($table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('customer');
            $table->string('project_manager');
            $table->string('list');
            $table->boolean('is_closed');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('app_projects_projects');
    }
}
