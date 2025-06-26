<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Story;
use App\Models\Talent;
use App\Models\Category;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class StorySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $talentIds = Talent::pluck('id')->toArray();
        $categoryIds = Category::pluck('id')->toArray();

        if (empty($talentIds)) {
            $this->command->warn('No talents found. Please seed talents first.');
            return;
        }

        if (empty($categoryIds)) {
            $this->command->warn('No categories found. Please seed categories first.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            $title = $faker->sentence(6);
            Story::create([
                'talent_id'   => $faker->randomElement($talentIds),
                'title'       => $title,
                'content'     => $faker->paragraph(4),
                'media'       => $faker->imageUrl(800, 450, 'nature', true), // URL to some media
                'thumbnail'   => $faker->imageUrl(320, 180, 'nature', true),
                'slug'        => Str::slug($title) . '-' . Str::random(5),
                'category_id' => $faker->randomElement($categoryIds),
                'tags'        => implode(',', $faker->words(3)), // comma-separated tags
                'status' => $faker->randomElement(['draft', 'published','archived']),
            ]);
        }
    }
}
