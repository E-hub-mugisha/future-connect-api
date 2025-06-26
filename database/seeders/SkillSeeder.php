<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;
use App\Models\Talent;
use App\Models\Category;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class SkillSeeder extends Seeder
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

        $levels = ['Beginner', 'Intermediate', 'Advanced', 'Expert'];
        $statuses = ['draft', 'published', 'archived'];

        for ($i = 0; $i < 10; $i++) {
            $name = $faker->unique()->jobTitle();

            Skill::create([
                'name'        => $name,
                'slug'        => Str::slug($name) . '-' . Str::random(5),
                'description' => $faker->sentence(10),
                'image'       => $faker->imageUrl(640, 480, 'technics', true),
                'talent_id'   => $faker->randomElement($talentIds),
                'category_id' => $faker->randomElement($categoryIds),
                'tags'        => implode(',', $faker->words(4)),
                'status'      => $faker->randomElement($statuses),
                'level'       => $faker->randomElement($levels),
            ]);
        }
    }
}
