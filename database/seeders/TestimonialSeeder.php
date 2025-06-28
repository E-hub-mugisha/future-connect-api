<?php

namespace Database\Seeders;

use App\Models\Talent;
use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure you have some talents in the database first
        $talentIds = Talent::pluck('id');

        if ($talentIds->isEmpty()) {
            $this->command->info('No talents found. Please seed talents first.');
            return;
        }

        foreach (range(1, 10) as $index) {
            Testimonial::create([
                'talent_id' => $talentIds->random(),
                'title' => 'Testimonial Title ' . $index,
                'content' => 'This is a sample testimonial content for testimonial ' . $index,
                'rating' => rand(1, 5),
            ]);
        }
    }
}
