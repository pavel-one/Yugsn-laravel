<?php

use App\Models\Region;
use App\Models\RegionCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(RegionCategory::table(), function (Blueprint $table) {
            $table->id();
            $table->string('name')
                ->unique()
                ->index();
            $table->timestamps();
        });

        Schema::table(Region::table(), function (Blueprint $table) {
            $table->foreignIdFor(RegionCategory::class)
                ->unsigned()
                ->nullable();
            $table->foreign('region_category_id')
                ->references('id')
                ->on(RegionCategory::table())
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Region::table(), function (Blueprint $table) {
            $table->dropForeign('regions_region_category_id_foreign');
        });
        Schema::dropIfExists(RegionCategory::table());

    }
}
