<?php

namespace Database\Factories;

use App\Models\MaterialCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialCategoryFactory extends Factory
{
    public const CATEGORY_NAMES = [
        'Власть',
        'Политика',
        'Экономика',
        'Происшествия',
        'Криминал',
        'Общество',
        'Культура',
        'Спорт',
        'Наука',
    ];

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MaterialCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $name = $this->getName();

        return [
            'name' => $name,
//            'slug' => \Str::random(40),
        ];
    }

    public function getName(): string
    {
        $name = self::CATEGORY_NAMES[rand(0, count(self::CATEGORY_NAMES) - 1)];

        $find = MaterialCategory::firstWhere('name', $name);

        if (!$find) {
            return $name;
        }

        return $this->getName();
    }
}
