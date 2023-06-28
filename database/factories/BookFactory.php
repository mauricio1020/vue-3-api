<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{

    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            "user_id" => User::all()->random()->id,
            "name" => $this->faker->text(30),
            "isbn" => $this->faker->isbn10,
            "author" => $this->faker->name(),
            "summary" => $this->faker->text(500),
        ];
    }
}
