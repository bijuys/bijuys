<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Default Admin User
        User::updateOrCreate(
            ['email' => 'admin@bijuys.com'],
            [
                'name' => 'Biju Yohannan',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Seed Default Settings
        $settings = [
            'site_name' => 'Bijuys',
            'owner_name' => 'Biju Yohannan',
            'owner_title' => 'Senior Full-Stack Engineer & Product Designer',
            'hero_badge' => 'Available for freelance & full-time roles',
            'hero_title' => 'Crafting fast, intuitive & human-centered web experiences.',
            'hero_subtitle' => 'Hi, I\'m Biju Yohannan. I\'m a full-stack engineer and digital product designer passionate about clean code, modern web standards, and high-impact digital products.',
            'stat_experience' => '7+',
            'stat_projects' => '45+',
            'stat_satisfaction' => '99%',
            'about_lead' => 'Bridging technical precision with thoughtful design.',
            'bio_image' => 'bio/xVOri6uVsKdtIa3AvfYuF9B1xvnOcR9oarSQXTn5.png',
            'about_bio_1' => 'I am a software engineer and designer working at the intersection of robust backend infrastructure and intuitive user interfaces.',
            'about_bio_2' => 'Over the last 7+ years, I’ve collaborated with fast-growing startups, creative agencies, and global technology teams. My focus is always on creating maintainable systems that serve real people without needless bloat.',
            'about_bio_3' => 'When I\'m not writing code or architecting APIs, you’ll find me contributing to open-source software, tinkering with mechanical keyboards, or exploring digital design trends.',
            'location' => 'San Francisco, CA (Remote Friendly)',
            'availability' => 'Open to Projects',
            'contact_email' => 'biju@bijuys.com',
            'contact_phone' => '+1 (555) 019-2834',
            'github_url' => 'https://github.com',
            'linkedin_url' => 'https://linkedin.com',
            'twitter_url' => 'https://twitter.com',
        ];

        foreach ($settings as $key => $val) {
            Setting::set($key, $val);
        }

        // 3. Seed Services
        $services = [
            [
                'title' => 'Frontend Engineering',
                'description' => 'Building responsive, accessible, and lightning-fast user interfaces using modern standards (HTML5, modern CSS, TypeScript, React, Vue, Blade).',
                'sort_order' => 1,
            ],
            [
                'title' => 'UI/UX Design Systems',
                'description' => 'Creating wireframes, interactive prototypes, and scalable design systems that put usability, accessibility, and visual harmony first.',
                'sort_order' => 2,
            ],
            [
                'title' => 'Backend & API Architecture',
                'description' => 'Architecting robust PHP/Laravel APIs, Node microservices, database optimizations, and secure authentication flows.',
                'sort_order' => 3,
            ],
            [
                'title' => 'Performance & Security',
                'description' => 'Optimizing Core Web Vitals, asset bundling, caching strategies, SQL queries, and rigorous web security practices.',
                'sort_order' => 4,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['title' => $service['title']], $service);
        }

        // 4. Seed Projects
        $projects = [
            [
                'title' => 'CloudFlow Telemetry',
                'slug' => 'cloudflow-telemetry',
                'category' => 'fullstack',
                'image' => 'projects/JDvPXmLmddEZFx3kBcIX31gRbFk4raFPkeFMTfq9.jpg',
                'tags' => 'Laravel, PostgreSQL, Redis, Tailwind',
                'description' => 'Real-time telemetry and infrastructure health SaaS dashboard. Supports streaming websocket ingestion, query caching, and custom alert rules with zero latency impact.',
                'badge_text' => 'SaaS / Web App',
                'live_url' => 'https://example.com/demo/cloudflow',
                'github_url' => 'https://github.com/bijuys/cloudflow',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'PulsePay Gateway',
                'slug' => 'pulsepay-gateway',
                'category' => 'fullstack',
                'image' => 'projects/cOJUbijEUT7hdwtR6oguzkBsh7rk4iJKSSXDsay9.png',
                'tags' => 'PHP, Stripe API, Vue.js, MySQL',
                'description' => 'High-conversion checkout UI and merchant portal engineered with bank-grade security, instant automated invoicing, and multi-currency billing compliance.',
                'badge_text' => 'Fintech / Platform',
                'live_url' => 'https://example.com/demo/pulsepay',
                'github_url' => 'https://github.com/bijuys/pulsepay',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'DevSphere Hub',
                'slug' => 'devsphere-hub',
                'category' => 'fullstack',
                'image' => 'projects/q3XHpwTVcUL3ZniXKOzJy6XfYHS5n2zUXB6T2K8o.jpg',
                'tags' => 'Laravel, Livewire, Alpine.js, SQLite',
                'description' => 'An interactive developer knowledge-sharing community featuring markdown publication, real-time code snippet running, and peer code reviews.',
                'badge_text' => 'Community / Open Source',
                'live_url' => 'https://example.com/demo/devsphere',
                'github_url' => 'https://github.com/bijuys/devsphere',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'StudioKite Architecture',
                'slug' => 'studiokite-architecture',
                'category' => 'design',
                'image' => 'projects/elfIijh7P5jV5TzFOXxNQiSRPFD0cxI7FOkjM9v6.jpg',
                'tags' => 'HTML5, CSS3, Modern JS, Figma',
                'description' => 'Minimalist editorial portfolio website designed for an architectural studio. Features smooth scroll physics, bespoke typography layouts, and interactive 3D spatial models.',
                'badge_text' => 'Design / Portfolio',
                'live_url' => 'https://example.com/demo/studiokite',
                'github_url' => 'https://github.com/bijuys/studiokite',
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'title' => 'TaskCraft Productivity',
                'slug' => 'taskcraft-productivity',
                'category' => 'frontend',
                'image' => 'projects/yyrgSB9PpfWFhuMRIeEZGvxBb68MULjmOzwuXgwe.png',
                'tags' => 'React, TypeScript, IndexedDB, CSS Grid',
                'description' => 'An offline-first Kanban board and productivity workspace. Synchronizes across devices seamlessly with conflict resolution algorithms and zero lag.',
                'badge_text' => 'App / Utility',
                'live_url' => 'https://example.com/demo/taskcraft',
                'github_url' => 'https://github.com/bijuys/taskcraft',
                'is_featured' => false,
                'sort_order' => 5,
            ],
            [
                'title' => 'EcoTrack Carbon Index',
                'slug' => 'ecotrack-carbon-index',
                'category' => 'design',
                'image' => 'projects/FDpzswIYSH4zORHVx0ZPsgO446EIRcNYX3a18QJL.jpg',
                'tags' => 'Vue.js, D3.js, Data Viz, SVG',
                'description' => 'An environmental sustainability reporting dashboard. Transforms complex corporate carbon emissions data into accessible interactive charts and exportable PDF summaries.',
                'badge_text' => 'Data Viz / Web App',
                'live_url' => 'https://example.com/demo/ecotrack',
                'github_url' => 'https://github.com/bijuys/ecotrack',
                'is_featured' => false,
                'sort_order' => 6,
            ],
        ];

        foreach ($projects as $proj) {
            Project::updateOrCreate(['slug' => $proj['slug']], $proj);
        }

        // 5. Seed Skills
        $skills = [
            // Frontend
            ['name' => 'HTML5 & Semantic Web', 'category' => 'Frontend', 'proficiency' => 98, 'sort_order' => 1],
            ['name' => 'CSS3 / PostCSS & Tailwind', 'category' => 'Frontend', 'proficiency' => 95, 'sort_order' => 2],
            ['name' => 'JavaScript (ESNext) & TypeScript', 'category' => 'Frontend', 'proficiency' => 92, 'sort_order' => 3],
            ['name' => 'Blade & Livewire', 'category' => 'Frontend', 'proficiency' => 95, 'sort_order' => 4],
            ['name' => 'Vue.js & React', 'category' => 'Frontend', 'proficiency' => 90, 'sort_order' => 5],
            ['name' => 'Web Accessibility (WCAG / a11y)', 'category' => 'Frontend', 'proficiency' => 94, 'sort_order' => 6],

            // Backend & Data
            ['name' => 'PHP 8.x & Laravel Framework', 'category' => 'Backend & Data', 'proficiency' => 96, 'sort_order' => 1],
            ['name' => 'MySQL & PostgreSQL', 'category' => 'Backend & Data', 'proficiency' => 90, 'sort_order' => 2],
            ['name' => 'Node.js & Express', 'category' => 'Backend & Data', 'proficiency' => 88, 'sort_order' => 3],
            ['name' => 'REST APIs & GraphQL', 'category' => 'Backend & Data', 'proficiency' => 92, 'sort_order' => 4],
            ['name' => 'Redis & SQLite', 'category' => 'Backend & Data', 'proficiency' => 88, 'sort_order' => 5],
            ['name' => 'Authentication & OAuth2', 'category' => 'Backend & Data', 'proficiency' => 92, 'sort_order' => 6],

            // DevOps & Cloud
            ['name' => 'Git & GitHub Actions', 'category' => 'DevOps & Cloud', 'proficiency' => 92, 'sort_order' => 1],
            ['name' => 'Docker & Containerization', 'category' => 'DevOps & Cloud', 'proficiency' => 85, 'sort_order' => 2],
            ['name' => 'Linux Server Administration', 'category' => 'DevOps & Cloud', 'proficiency' => 86, 'sort_order' => 3],
            ['name' => 'AWS & Cloudflare Edge', 'category' => 'DevOps & Cloud', 'proficiency' => 84, 'sort_order' => 4],
            ['name' => 'CI/CD Automated Deployments', 'category' => 'DevOps & Cloud', 'proficiency' => 88, 'sort_order' => 5],

            // Design & Workflow
            ['name' => 'Figma & UI Prototyping', 'category' => 'Design & Workflow', 'proficiency' => 90, 'sort_order' => 1],
            ['name' => 'Design Systems & Tokens', 'category' => 'Design & Workflow', 'proficiency' => 92, 'sort_order' => 2],
            ['name' => 'Performance Auditing (Lighthouse)', 'category' => 'Design & Workflow', 'proficiency' => 95, 'sort_order' => 3],
            ['name' => 'Agile / Scrum Collaboration', 'category' => 'Design & Workflow', 'proficiency' => 90, 'sort_order' => 4],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(['name' => $skill['name'], 'category' => $skill['category']], $skill);
        }

        // 6. Seed Experiences
        $experiences = [
            [
                'role' => 'Lead Full-Stack Engineer',
                'company' => 'Aura Labs',
                'location' => 'San Francisco, CA',
                'period' => '2023 – Present',
                'description' => 'Spearheading core web architecture and design system for next-generation developer telemetry tools. Improved Lighthouse performance scores from 64 to 98 across all landing pages and web apps.',
                'sort_order' => 1,
            ],
            [
                'role' => 'Senior Software Engineer',
                'company' => 'Hyperion Tech',
                'location' => 'Remote',
                'period' => '2021 – 2023',
                'description' => 'Designed and built distributed microservices in Laravel and TypeScript, handling real-time financial data feeds. Collaborated with UX researchers to overhaul user onboarding, cutting drop-off by 28%.',
                'sort_order' => 2,
            ],
            [
                'role' => 'Web Developer & Designer',
                'company' => 'Pixelcraft Agency',
                'location' => 'New York, NY',
                'period' => '2019 – 2021',
                'description' => 'Developed custom responsive websites, client dashboards, and e-commerce platforms for over 25 clients. Implemented automated accessibility auditing tests into the company’s deployment pipeline.',
                'sort_order' => 3,
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::updateOrCreate(['role' => $exp['role'], 'company' => $exp['company']], $exp);
        }

        // 7. Seed Initial Blog Articles
        $posts = [
            [
                'title' => 'Architecting Resilient Full-Stack Systems with Laravel & Modern Web Standards',
                'slug' => 'architecting-resilient-fullstack-systems-laravel',
                'category' => 'Laravel & PHP',
                'tags' => 'php, laravel, architecture, backend, api',
                'read_time' => '6 min read',
                'image' => 'posts/qpHqyWu0SAT8aNO0FcnfR3vNmggNdIp86FhJOzlZ.png',
                'excerpt' => 'A practical guide to decoupling business logic from framework layers, structuring background queues, and designing APIs that scale effortlessly.',
                'content' => "When building web applications destined for serious production workloads, architectural foresight pays enormous dividends.\n\n### 1. Decoupling the Domain Layer\nMany applications suffer from bloated controllers or an over-reliance on Active Record shortcuts. While Laravel's Eloquent is wonderfully ergonomic, encapsulating business rules inside explicit Action classes or Service layers preserves testability and readability as systems mature.\n\n### 2. Async Queues & Job Processing\nNever force end users to wait on external network calls or expensive file operations. Offloading notifications, report generation, and third-party API syncs to Redis-backed queues ensures that HTTP response times remain under 50ms.\n\n### 3. Database Indexing & Query Optimization\nAlways profile queries with strict query logging or tools like Laravel Telescope. A single missing composite index can turn a 2ms query into a 400ms CPU bottleneck when tables grow past hundreds of thousands of rows.\n\nEmbrace simplicity, measure latency relentlessly, and write code that your future self will thank you for.",
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Why Modern Native CSS Replaced Bulky Utility Frameworks in My Projects',
                'slug' => 'why-modern-native-css-replaced-bulky-frameworks',
                'category' => 'Frontend & CSS',
                'tags' => 'css, web standards, responsive design, performance',
                'read_time' => '5 min read',
                'image' => 'posts/coTsWgmKxhBv2YCKsIlppPkW8niObFMhOr1zsYt1.jpg',
                'excerpt' => 'Exploring how container queries, CSS custom properties, and modern nesting make shipping lean, zero-dependency stylesheets easier than ever.',
                'content' => "For years, the frontend ecosystem gravitated toward massive CSS toolchains and utility classes to achieve component consistency. However, the browser standards landscape has dramatically transformed.\n\n### Baseline Features Are Here\nWith Baseline availability across Chrome, Edge, Safari, and Firefox for CSS nesting, custom properties, `:has()`, and `@starting-style`, native CSS provides immense expressive power without runtime bloat.\n\n### Container Queries Shift the Paradigm\nInstead of tying UI breakpoints strictly to viewport widths, `@container` queries allow individual cards and widgets to respond dynamically to their parent element's dimensions. A component can now adapt seamlessly whether embedded inside a narrow sidebar or a wide grid.\n\n### The Result: Faster Load Times\nEliminating thousands of utility class rules and external CSS dependencies drastically trims critical render path stylesheets down to single-digit kilobytes, producing near-perfect Core Web Vitals scores.",
                'is_published' => true,
                'published_at' => now()->subDays(8),
            ],
            [
                'title' => 'Mastering Core Web Vitals: A Real-World Performance Playbook',
                'slug' => 'mastering-core-web-vitals-performance-playbook',
                'category' => 'Performance',
                'tags' => 'performance, lighthouse, cwv, web development',
                'read_time' => '7 min read',
                'image' => 'posts/0NcXnrwg0E6f0TiDGY80DN2Wupma7CApZmFFN604.webp',
                'excerpt' => 'Actionable strategies for optimizing Largest Contentful Paint (LCP), reducing Cumulative Layout Shift (CLS), and minimizing Interaction to Next Paint (INP).',
                'content' => "Web performance is not merely a technical benchmark—it directly governs user engagement, conversion rates, and search discoverability.\n\n### 1. Accelerating Largest Contentful Paint (LCP)\nYour LCP element is typically a hero headline or featured hero graphic. Preloading critical fonts with `font-display: swap`, serving images in AVIF/WebP formats with explicit `fetchpriority=\"high\"`, and inlining critical CSS can cut LCP by more than 60%.\n\n### 2. Eliminating Cumulative Layout Shift (CLS)\nUnexpected visual jumping frustrates readers and penalizes search engine ranking. Always specify `width` and `height` (or CSS `aspect-ratio`) on images and responsive embeds so the layout engine reserves the necessary canvas space before assets download.\n\n### 3. Taming Interaction to Next Paint (INP)\nKeep the main JavaScript thread unblocked by breaking up long tasks, deferring non-essential analytics scripts, and avoiding synchronous DOM thrashing inside animation handlers.\n\nA fast site feels polite, professional, and reliable.",
                'is_published' => true,
                'published_at' => now()->subDays(15),
            ],
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
