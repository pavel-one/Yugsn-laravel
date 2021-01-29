<?php

namespace Database\Seeders;

use App\Models\MaterialCategory;
use App\Models\User;
use App\Models\UserMaterial;
use Database\Factories\MaterialCategoryFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory(10)
             ->create();

         MaterialCategory::factory(count(MaterialCategoryFactory::CATEGORY_NAMES))
             ->create();

         UserMaterial::factory(500)
             ->create();
    }
}
