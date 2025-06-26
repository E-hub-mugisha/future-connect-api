<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ensure at least one user and category exist
        $userId = User::inRandomOrder()->value('id');
        $categoryId = Category::inRandomOrder()->value('id');

        if (!$userId || !$categoryId) {
            $this->command->warn('Please ensure at least one user and category exist before seeding announcements.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            Announcement::create([
                'title'       => $faker->sentence(6),
                'content'     => $faker->paragraph(4),
                'image'       => $faker->imageUrl(640, 480, 'business', true),
                'link'        => $faker->url(),
                'is_active'   => $faker->boolean(80), // 80% chance it's active
                'created_by'  => $userId,
                'category_id' => $categoryId,
            ]);
        }
    }
}
