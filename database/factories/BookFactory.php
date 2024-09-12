<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'author' => $this->faker->name,
            'title' => $this->faker->sentence,
            'publish_date' => $this->faker->date,
            'isbn' => $this->faker->isbn13,
            'summary' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 5, 100),
            'on_store' => $this->faker->boolean,
        ];
    }
}
