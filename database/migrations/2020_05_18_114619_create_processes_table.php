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
            $table->longText('flowchart')->default('');
//            $table->longText('blocks')->default('');
            $table->longText('long_des')->default('');
//            $table->unsignedInteger('assigned_user')->default(0);
//            $table->string('url')->default('');
//            $table->unsignedInteger('process')->default(0);
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
