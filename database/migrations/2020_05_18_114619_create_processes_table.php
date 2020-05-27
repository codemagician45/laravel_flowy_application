<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->unsignedInteger('sysnum');
            $table->unsignedInteger('theme_id');
            $table->unsignedInteger('fase_id');
            $table->unsignedInteger('user_id');
            $table->longText('flowchart')->nullable();
            $table->longText('block_data')->nullable();
            $table->string('role_data')->nullable();
            $table->longText('long_des')->nullable();
            $table->string('commit')->nullable();
            $table->unsignedInteger('user_make_changed')->default(0);
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('processes');
    }
}
