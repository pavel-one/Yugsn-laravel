<?php

use App\Models\MaterialCategory;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->nullable();
            $table->foreignIdFor(MaterialCategory::class, 'category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on(MaterialCategory::table())
                ->onDelete('cascade');
            $table->string('title');
            $table->string('long_title');
            $table->longText('content')
                ->nullable();
            $table->boolean('published')
                ->default(0);
            $table->dateTime('published_time')
                ->nullable();
            $table->json('tags')
                ->nullable()
//                ->index()
            ;
            $table->string('slug')
                ->unique()
                ->index()
            ;
            $table->integer('views')
                ->unsigned()
                ->default(0);
            $table->string('region_alias', 100)
                ->nullable()
                ->index();
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
        Schema::dropIfExists('user_materials');
    }
}
