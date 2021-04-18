<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent')->index();
            $table->unsignedBigInteger('parent_comment')->nullable()->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('theme')->index();
            $table->string('username')->nullable();
            $table->string('ip')->nullable();
            $table->string('email')->nullable();
            $table->text('text');
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
        Schema::dropIfExists('comments');
    }
}
