<?php

namespace Database\Factories;

use App\Models\MaterialCategory;
use App\Models\User;
use App\Models\UserMaterial;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserMaterialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserMaterial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->getUserId(),
            'category_id' => $this->getCategoryId(),
            'title' => $this->faker->city,
            'long_title' => $this->faker->company,
            'content' => $this->faker->realText(1200),
            'published' => true,
            'slug' => \Str::random(40),
            'views' => rand(100, 1000000),
        ];
    }

    public function getCategoryId(): int
    {
        /** @var MaterialCategory[] $categories */
        $categories = MaterialCategory::select('id')
            ->get()
            ->all();

        return $categories[rand(0, count($categories) - 1)]->id;
    }

    public function getUserId(): int
    {
        /** @var User[] $users */
        $users = User::select('id')->get()->all();

        return $users[rand(0, count($users) - 1)]->id;
    }
}
