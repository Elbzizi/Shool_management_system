<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class admin_matier_groupeFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'groupe_id' => fake()->numberBetween(1, 5),
      'admin_id' => 1,
      'matier_id' => fake()->numberBetween(1, 5),
    ];
  }
}
