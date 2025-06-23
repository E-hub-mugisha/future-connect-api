<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Web Development',
                'description' => 'Frontend, backend, and full-stack talent.',
                'featured' => true,
                'image' => 'https://via.placeholder.com/100',
            ],
            [
                'name' => 'Graphic Design',
                'description' => 'Logo design, branding, and UI/UX experts.',
                'featured' => false,
                'image' => 'https://via.placeholder.com/100',
            ],
            [
                'name' => 'Music & Audio',
                'description' => 'Musicians, producers, and audio engineers.',
                'featured' => false,
                'image' => 'https://via.placeholder.com/100',
            ],
            [
                'name' => 'Photography',
                'description' => 'Professional photographers and editors.',
                'featured' => false,
                'image' => 'https://via.placeholder.com/100',
            ],
            [
                'name' => 'Digital Marketing',
                'description' => 'SEO, social media, and ad campaign talents.',
                'featured' => true,
                'image' => 'https://via.placeholder.com/100',
            ],
            [
                'name' => 'Writing & Translation',
                'description' => 'Writers, editors, and translators.',
                'featured' => false,
                'image' => 'https://via.placeholder.com/100',
            ],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat['name'],
                'description' => $cat['description'],
                'featured' => $cat['featured'],
                'image' => $cat['image'],
                'slug' => Str::slug($cat['name']),
            ]);
        }
    }
}
