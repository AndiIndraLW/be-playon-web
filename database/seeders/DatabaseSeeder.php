<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@playon.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );

        $categoryNews = Category::firstOrCreate(
            ['slug' => 'news'],
            [
                'name' => 'News & Updates',
                'description' => 'Latest announcements and platform updates.',
                'is_active' => true,
            ]
        );

        $categoryTutorials = Category::firstOrCreate(
            ['slug' => 'tutorials'],
            [
                'name' => 'Tutorials & Guides',
                'description' => 'Helpful step-by-step guides for users.',
                'is_active' => true,
            ]
        );

        Post::firstOrCreate(
            ['slug' => 'welcome-to-playon-dashboard'],
            [
                'category_id' => $categoryNews->id,
                'author_id' => $admin->id,
                'title' => 'Welcome to PlayOn Dynamic Dashboard',
                'excerpt' => 'An introduction to managing your dynamic content seamlessly using Filament Admin.',
                'content' => '<p>Welcome to your new dashboard! Here you can create and manage posts, categories, banners, and users dynamically.</p>',
                'status' => 'published',
                'published_at' => now(),
            ]
        );

        Banner::firstOrCreate(
            ['title' => 'Main Launch Banner'],
            [
                'link_url' => 'https://example.com',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );
    }
}
