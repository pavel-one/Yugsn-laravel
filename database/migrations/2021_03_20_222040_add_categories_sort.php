<?php

use App\Models\MaterialCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoriesSort extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(MaterialCategory::table(), function (Blueprint $table) {
            $table->tinyInteger('sort')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(MaterialCategory::table(), function (Blueprint $table) {
            $table->dropColumn('sort');
        });
    }
}
