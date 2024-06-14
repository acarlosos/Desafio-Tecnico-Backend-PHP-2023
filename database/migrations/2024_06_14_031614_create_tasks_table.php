<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId( 'user_id' )->constrained();
            $table->foreignId( 'type_id' )->constrained();
            $table->string('title');
            $table->string('type');
            $table->longText('description');
            $table->date('start_date')->nullable();
            $table->date('deadline')->nullable();
            $table->date('finish_date')->nullable();
            $table->enum('status', ['open', 'concluded']);
            $table->timestamps();
            $table->softDeletes();
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