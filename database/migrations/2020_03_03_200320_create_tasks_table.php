<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// @phpcs:ignore PSR1.Classes.ClassDeclaration.MissingNamespace
class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     * @SuppressWarnings(PHPMD.ShortMethodName)
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->foreignId('parent_id')->nullable();
            $table->string('name');
            $table->tinyInteger('position')->unsigned();
            $table->tinyInteger('completion')->unsigned()->default(0);
            $table->mediumInteger('estimated_time')->unsigned()->default(0);
            $table->mediumInteger('spent_time')->unsigned()->default(0);
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
