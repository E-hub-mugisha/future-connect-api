<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SkillReview;
use App\Models\Skill;
use Faker\Factory as Faker;

class SkillReviewSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $skillIds = Skill::pluck('id')->toArray();

        if (empty($skillIds)) {
            $this->command->warn('No skills found. Please seed skills first.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            SkillReview::create([
                'skill_id' => $faker->randomElement($skillIds),
                'name'     => $faker->name(),
                'email'    => $faker->unique()->safeEmail(),
                'rating'   => $faker->numberBetween(1, 5),
                'message'  => $faker->sentence(12),
            ]);
        }
    }
}
