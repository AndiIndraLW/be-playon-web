<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\HomepageSetting;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Homepage Settings
        HomepageSetting::updateOrCreate(
            ['id' => 1],
            [
                'hero_bg_video' => null, // fallback to static video if empty
                'hero_title' => 'Play On, Next-Gen Visuals & Immersive Broadcast Experiences',
                'section_1_text' => 'PLAYON IS AN ESports AND CREATIVE TECHNOLOGY STUDIO SPECIALIZING IN ARENA BROADCASTS, 3D STAGE VISUALS, AND BRAND EXPERIENCES WORLDWIDE.',
                'section_1_button_text' => 'contact us',
                'section_1_button_link' => '/contact',
            ]
        );

        // 2. Testimonials
        if (Testimonial::count() === 0) {
            Testimonial::create([
                'name' => 'Marcus Vance',
                'title' => 'Global Head of Esports, Electronic Arts',
                'testimony' => '“Partnering with PlayOn transformed our global championship broadcast into an unforgettable cinematic experience. Their attention to detail, motion graphic mastery, and seamless execution under tight live broadcast pressure set a new benchmark for our brand.”',
            ]);

            Testimonial::create([
                'name' => 'Elena Rostova',
                'title' => 'Creative Director, Sony Interactive Entertainment',
                'testimony' => '“PlayOn brought a level of visual sophistication and immersive storytelling that exceeded our wildest expectations. From concept to final delivery, their team demonstrated unrivaled creative direction and technical precision.”',
            ]);

            Testimonial::create([
                'name' => 'David K. Sterling',
                'title' => 'VP of Global Marketing, Red Bull Media House',
                'testimony' => '“Working with PlayOn is effortless yet extraordinary. They understand youth culture and high-octane gaming aesthetics better than anyone in the industry.”',
            ]);
        }

        // 3. Projects
        if (Project::count() === 0) {
            Project::create([
                'slug' => 'valhalla-world-series-2026',
                'title' => 'Valhalla World Series 2026',
                'sub_title' => 'E-Sports & Live Event',
                'tag' => ['E-Sports', 'Live Production'],
                'year' => 2026,
                'featured_image' => '/assets/dummyimghl/dummyimghl1.jpeg',
                'description' => '<p>Full stage graphics, broadcast overlays, and telemetry visuals for Valhalla World Series 2026.</p>',
            ]);

            Project::create([
                'slug' => 'hyperion-genesis-campaign',
                'title' => 'Hyperion Genesis Campaign',
                'sub_title' => 'Brand Experience & Motion',
                'tag' => ['Branding', 'Motion'],
                'year' => 2026,
                'featured_image' => '/assets/dummyimghl/dummyimghl2.jpg',
                'description' => '<p>3D motion campaign rollouts for Hyperion Genesis global launch.</p>',
            ]);

            Project::create([
                'slug' => 'astral-rift-championship',
                'title' => 'Astral Rift Championship',
                'sub_title' => '3D VFX & Stage Broadcast',
                'tag' => ['3D VFX', 'Stage'],
                'year' => 2025,
                'featured_image' => '/assets/dummyimghl/dummyimghl3.jpg',
                'description' => '<p>Real-time Unreal Engine projection mapping and stadium VFX stage screens.</p>',
            ]);

            Project::create([
                'slug' => 'spectra-engine-launch',
                'title' => 'Spectra Engine Launch',
                'sub_title' => 'Interactive Web & Sound',
                'tag' => ['WebGL', 'Audio'],
                'year' => 2025,
                'featured_image' => '/assets/dummyimghl/dummyimghl4.jpg',
                'description' => '<p>Interactive WebGL web experience with reactive spatial audio design.</p>',
            ]);

            Project::create([
                'slug' => 'apex-dynasty-invitational',
                'title' => 'Apex Dynasty Invitational',
                'sub_title' => 'Global Gaming Broadcast',
                'tag' => ['Broadcast', 'Esports'],
                'year' => 2025,
                'featured_image' => '/assets/dummyimghl/dummyimghl5.jpg',
                'description' => '<p>End-to-end tournament packaging and trophy ceremony visuals.</p>',
            ]);
        }

        // 4. Services
        if (Service::count() === 0) {
            Service::create([
                'slug' => 'esports-arena-broadcast',
                'title' => 'E-Sports & Arena Broadcast',
                'sub_title' => 'Live Production • Arena Visuals • Real-time Graphics',
                'featured_image' => '/assets/dummyimghl/dummyimghl1.jpeg',
                'description' => 'Engineered for maximum crowd excitement. We design end-to-end stadium broadcast graphics, live stage telemetry, and instant replay systems.',
            ]);

            Service::create([
                'slug' => 'brand-experiences-motion',
                'title' => 'Brand Experiences & Motion',
                'sub_title' => 'Visual Identity • Kinetic Typography • 3D Motion',
                'featured_image' => '/assets/dummyimghl/dummyimghl2.jpg',
                'description' => 'Crafting high-impact motion identities for global gaming brands. From kinetic logos to multi-screen campaign rollouts.',
            ]);

            Service::create([
                'slug' => '3d-stage-vfx-animation',
                'title' => '3D Stage & VFX Animation',
                'sub_title' => 'Unreal Engine • Projection Mapping • Virtual Sets',
                'featured_image' => '/assets/dummyimghl/dummyimghl3.jpg',
                'description' => 'Photorealistic 3D environments and stage projection mapping powered by real-time Unreal Engine rendering.',
            ]);

            Service::create([
                'slug' => 'interactive-web-audio',
                'title' => 'Interactive Web & Audio',
                'sub_title' => 'WebGL Experiences • Spatial Sound • Digital Products',
                'featured_image' => '/assets/dummyimghl/dummyimghl4.jpg',
                'description' => 'Immersive digital web experiences paired with custom sound design and spatial audio engineered for deep player engagement.',
            ]);

            Service::create([
                'slug' => 'global-tournament-branding',
                'title' => 'Global Tournament Branding',
                'sub_title' => 'Broadcast Package • Trophy Ceremonies • Event Design',
                'featured_image' => '/assets/dummyimghl/dummyimghl5.jpg',
                'description' => 'Full-spectrum branding for major esports championships, including opening ceremony visual shows and custom trophy reveals.',
            ]);
        }

        // 5. Articles
        if (Article::count() === 0) {
            Article::create([
                'slug' => 'future-of-esports-broadcasts',
                'title' => 'The Future of Competitive Gaming Broadcasts',
                'sub_title' => '3D Motion & AR Stage Visuals',
                'featured_image' => '/assets/dummyimghl/dummyimghl1.jpeg',
                'description' => 'Explore how 3D motion environments, real-time spatial analytics, and immersive AR stage visuals are redefining live esports entertainment for millions worldwide.',
                'published_at' => now(),
            ]);

            Article::create([
                'slug' => 'building-iconic-brand-experiences',
                'title' => 'Building Iconic Brand Experiences in 2026',
                'sub_title' => 'Digital-First Brand Identities',
                'featured_image' => '/assets/dummyimghl/dummyimghl2.jpg',
                'description' => 'Discover our strategic design blueprint for building digital-first brand identities that resonate with next-generation global gaming audiences.',
                'published_at' => now(),
            ]);

            Article::create([
                'slug' => 'next-gen-motion-graphics',
                'title' => 'Next-Gen Motion Graphics for Arena Shows',
                'sub_title' => 'Projection Mapping & LED Stage Choreography',
                'featured_image' => '/assets/dummyimghl/dummyimghl3.jpg',
                'description' => 'A deep dive into high-framerate visual synthesis, projection mapping, and dynamic LED stage choreography designed for massive stadium events.',
                'published_at' => now(),
            ]);

            Article::create([
                'slug' => 'interactive-sound-and-visuals',
                'title' => 'Interactive Sound & Visual Production Techniques',
                'sub_title' => 'Spatial Audio & Reactive Visual Shaders',
                'featured_image' => '/assets/dummyimghl/dummyimghl4.jpg',
                'description' => 'How spatial audio algorithms and reactive visual shaders create visceral, heart-pounding moments during live gaming broadcasts.',
                'published_at' => now(),
            ]);
        }
    }
}
