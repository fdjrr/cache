<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'user_id'     => $this->faker->numberBetween(1, 10),
      'title'       => $this->faker->sentence(),
      'slug'        => $this->faker->slug(),
      'body'        => $this->faker->paragraphs(3, true),
      'category_id' => $this->faker->numberBetween(1, 5),
    ];
  }
}
