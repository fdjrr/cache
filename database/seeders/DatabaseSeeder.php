<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $categories = ['Programming', 'Design', 'Lifestyle', 'Travel', 'Food'];
    Category::insert(array_map(fn($category) => ['name' => $category], $categories));

    User::factory(10)->create();

    Article::factory(10000)->create();

    // User::factory()->create([
    //   'name'  => 'Test User',
    //   'email' => 'test@example.com',
    // ]);
  }
}
