<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Talent;
use App\Models\Category;
use Faker\Factory as Faker;

class TalentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categoryIds = Category::pluck('id')->toArray();

        if (empty($categoryIds)) {
            $this->command->warn('No categories found. Please seed categories first.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            Talent::create([
                'name'        => $faker->name(),
                'skill'       => $faker->randomElement([
                    'Web Development', 
                    'Graphic Design', 
                    'Digital Marketing', 
                    'UI/UX Design', 
                    'Mobile App Development', 
                    'Photography', 
                    'Video Editing', 
                    'Copywriting',
                    'Full Stack Development',
                    'SEO Specialist'
                ]),
                'story'       => $faker->paragraph(3),
                'rating'      => $faker->numberBetween(1, 5),
                'status'      => $faker->randomElement(['pending', 'approved', 'rejected']),
                'featured'    => $faker->boolean(),
                'description' => $faker->sentence(),
                'image'       => $faker->imageUrl(640, 480, 'people', true),
                'address'     => $faker->address(),
                'phone'       => $faker->phoneNumber(),
                'email'       => $faker->unique()->safeEmail(),
                'language'    => $faker->randomElement(['English', 'French', 'Spanish', 'Kinyarwanda']),
                'category_id' => $faker->randomElement($categoryIds),
            ]);
        }
    }
}
