<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Test all public pages return status 200.
     */
    public function test_public_pages_return_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Bijuys');
        $response->assertSee('Biju Yohannan');

        $response = $this->get('/about');
        $response->assertStatus(200);
        $response->assertSee('Toolkit');

        $response = $this->get('/work');
        $response->assertStatus(200);
        $response->assertSee('Selected Projects');

        $response = $this->get('/blog');
        $response->assertStatus(200);
        $response->assertSee('Articles');

        // Test blog single page
        $post = Post::published()->first();
        if ($post) {
            $postResponse = $this->get("/blog/{$post->slug}");
            $postResponse->assertStatus(200);
            $postResponse->assertSee($post->title);
        }

        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('Send a Message');
    }

    /**
     * Test contact form submission.
     */
    public function test_contact_form_submission(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Jane Client',
            'email' => 'jane@example.com',
            'subject' => 'Project Inquiry',
            'message' => 'Hello Biju, I would love to discuss an upcoming project with you.',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'jane@example.com',
        ]);
    }

    /**
     * Test admin login and protected dashboard.
     */
    public function test_admin_authentication_and_dashboard(): void
    {
        // Unauthenticated access redirects to login
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');

        // Login page has theme switcher
        $loginPage = $this->get('/admin/login');
        $loginPage->assertStatus(200);
        $loginPage->assertSee('admin-theme-toggle');

        // Login as admin
        $response = $this->post('/admin/login', [
            'email' => 'admin@bijuys.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin');

        // Authenticated user can see dashboard and theme switcher
        $user = User::where('email', 'admin@bijuys.com')->first();
        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Overview');
        $response->assertSee('Blog Articles');
        $response->assertSee('admin-theme-toggle');
    }

    /**
     * Test updating site settings dynamically including bio photo upload.
     */
    public function test_admin_can_update_settings(): void
    {
        Storage::fake('public');
        $user = User::where('email', 'admin@bijuys.com')->first();

        $bioFile = UploadedFile::fake()->image('my-bio-photo.jpg', 600, 600);

        $response = $this->actingAs($user)->post('/admin/settings', [
            'site_name' => 'Bijuys',
            'owner_name' => 'Biju Yohannan',
            'hero_title' => 'Building Scalable Full-Stack Web Apps',
            'bio_image' => $bioFile,
        ]);

        $response->assertRedirect('/admin/settings');
        $this->assertEquals('Building Scalable Full-Stack Web Apps', Setting::get('hero_title'));

        $bioPath = Setting::get('bio_image');
        $this->assertNotNull($bioPath);
        Storage::disk('public')->assertExists($bioPath);

        // Public pages reflect the updated content and bio image
        $homeResponse = $this->get('/');
        $homeResponse->assertSee('Building Scalable Full-Stack Web Apps');
        $homeResponse->assertSee(Setting::getBioImageUrl());

        $aboutResponse = $this->get('/about');
        $aboutResponse->assertStatus(200);
        $aboutResponse->assertSee(Setting::getBioImageUrl());
    }

    /**
     * Test admin can create, update and delete projects with mandatory image upload.
     */
    public function test_admin_project_crud(): void
    {
        Storage::fake('public');
        $user = User::where('email', 'admin@bijuys.com')->first();

        // 1. Missing image fails validation
        $invalidResponse = $this->actingAs($user)->post('/admin/projects', [
            'title' => 'Missing Image Project',
            'category' => 'fullstack',
            'description' => 'A project without image.',
        ]);
        $invalidResponse->assertSessionHasErrors(['image']);

        // 2. Create project with image upload
        $imageFile = UploadedFile::fake()->image('project-cover.jpg', 800, 500);
        $response = $this->actingAs($user)->post('/admin/projects', [
            'title' => 'Spectra Engine',
            'category' => 'fullstack',
            'image' => $imageFile,
            'tags' => 'PHP, Laravel, Vue',
            'description' => 'A high throughput data analytics tool.',
            'live_url' => 'https://example.com/spectra',
            'is_featured' => '1',
            'sort_order' => 0,
        ]);

        $response->assertRedirect('/admin/projects');
        $this->assertDatabaseHas('projects', ['title' => 'Spectra Engine']);

        $project = Project::where('title', 'Spectra Engine')->first();
        $this->assertNotNull($project->image);
        Storage::disk('public')->assertExists($project->image);

        // Verify project image is rendered on work page and home page
        $workResponse = $this->get('/work');
        $workResponse->assertStatus(200);
        $workResponse->assertSee($project->image_url);

        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee($project->image_url);

        // 3. Update project with replacement image
        $oldImagePath = $project->image;
        $newImageFile = UploadedFile::fake()->image('new-project-cover.png', 800, 500);

        $updateResponse = $this->actingAs($user)->put("/admin/projects/{$project->id}", [
            'title' => 'Spectra Engine Pro',
            'category' => 'fullstack',
            'image' => $newImageFile,
            'tags' => 'PHP, Laravel, Vue, Redis',
            'description' => 'Updated high throughput data engine.',
            'is_featured' => '1',
            'sort_order' => 10,
        ]);

        $updateResponse->assertRedirect('/admin/projects');
        $this->assertDatabaseHas('projects', ['title' => 'Spectra Engine Pro']);

        $project->refresh();
        $this->assertNotEquals($oldImagePath, $project->image);
        Storage::disk('public')->assertExists($project->image);
        Storage::disk('public')->assertMissing($oldImagePath);

        // 4. Delete project deletes image file from storage
        $deletedImagePath = $project->image;
        $deleteResponse = $this->actingAs($user)->delete("/admin/projects/{$project->id}");
        $deleteResponse->assertRedirect('/admin/projects');
        $this->assertDatabaseMissing('projects', ['title' => 'Spectra Engine Pro']);
        Storage::disk('public')->assertMissing($deletedImagePath);
    }

    /**
     * Test admin can create, update and delete blog posts with mandatory image upload.
     */
    public function test_admin_post_crud(): void
    {
        Storage::fake('public');
        $user = User::where('email', 'admin@bijuys-app.test')->first() ?? User::first();

        // 1. Verify image is required when creating a post
        $invalidResponse = $this->actingAs($user)->post('/admin/posts', [
            'title' => 'Missing Image Post',
            'category' => 'Laravel & PHP',
            'excerpt' => 'No image provided.',
            'content' => 'This should fail validation because an image is required.',
        ]);
        $invalidResponse->assertSessionHasErrors(['image']);

        // 2. Create post with uploaded image
        $imageFile = UploadedFile::fake()->image('cover.jpg', 1200, 630);
        $response = $this->actingAs($user)->post('/admin/posts', [
            'title' => 'Understanding SQLite with Laravel',
            'category' => 'Laravel & PHP',
            'tags' => 'sqlite, laravel, database',
            'read_time' => '4 min read',
            'image' => $imageFile,
            'excerpt' => 'Why SQLite is now a first-class citizen in Laravel development.',
            'content' => 'SQLite offers zero latency and simplifies local prototyping drastically.',
            'is_published' => '1',
            'published_at' => now()->toDateString(),
        ]);

        $response->assertRedirect('/admin/posts');
        $this->assertDatabaseHas('posts', ['title' => 'Understanding SQLite with Laravel']);

        $post = Post::where('title', 'Understanding SQLite with Laravel')->first();
        $this->assertNotNull($post->image);
        Storage::disk('public')->assertExists($post->image);

        // Verify post image is displayed on public blog page
        $blogResponse = $this->get('/blog');
        $blogResponse->assertStatus(200);
        $blogResponse->assertSee($post->image_url);

        $singleResponse = $this->get("/blog/{$post->slug}");
        $singleResponse->assertStatus(200);
        $singleResponse->assertSee($post->image_url);

        // 3. Update post with replacement image
        $oldImagePath = $post->image;
        $newImageFile = UploadedFile::fake()->image('new-cover.png', 1200, 630);

        $updateResponse = $this->actingAs($user)->put("/admin/posts/{$post->id}", [
            'title' => 'Understanding SQLite with Laravel 11',
            'category' => 'Laravel & PHP',
            'tags' => 'sqlite, laravel, database, php',
            'read_time' => '5 min read',
            'image' => $newImageFile,
            'excerpt' => 'Updated review of SQLite in modern Laravel.',
            'content' => 'Updated content body with benchmarks.',
            'is_published' => '1',
        ]);

        $updateResponse->assertRedirect('/admin/posts');
        $this->assertDatabaseHas('posts', ['title' => 'Understanding SQLite with Laravel 11']);

        $post->refresh();
        $this->assertNotEquals($oldImagePath, $post->image);
        Storage::disk('public')->assertExists($post->image);
        Storage::disk('public')->assertMissing($oldImagePath);

        // 4. Delete post deletes stored image
        $deletedImagePath = $post->image;
        $deleteResponse = $this->actingAs($user)->delete("/admin/posts/{$post->id}");
        $deleteResponse->assertRedirect('/admin/posts');
        $this->assertDatabaseMissing('posts', ['title' => 'Understanding SQLite with Laravel 11']);
        Storage::disk('public')->assertMissing($deletedImagePath);
    }

    /**
     * Test the user's custom name logo is cleanly deployed across the public site, footer, login, and admin.
     */
    public function test_custom_name_logo_rendered_across_website_and_admin(): void
    {
        // 1. Home page renders both dark and light name logo variants and custom favicon
        $home = $this->get('/');
        $home->assertStatus(200);
        $home->assertSee('images/bijuys-logo-dark.png');
        $home->assertSee('images/bijuys-logo-light.png');
        $home->assertSee('images/bijuys-icon.png');
        $home->assertDontSee('logo-icon.svg');

        // 2. Login page renders the name logo
        $login = $this->get('/admin/login');
        $login->assertStatus(200);
        $login->assertSee('images/bijuys-logo-dark.png');
        $login->assertSee('images/bijuys-logo-light.png');
        $login->assertSee('images/bijuys-icon.png');
        $login->assertDontSee('logo-icon.svg');

        // 3. Admin dashboard renders the name logo in the sidebar
        $user = User::where('email', 'admin@bijuys.com')->first();
        $admin = $this->actingAs($user)->get('/admin');
        $admin->assertStatus(200);
        $admin->assertSee('images/bijuys-logo-dark.png');
        $admin->assertSee('images/bijuys-logo-light.png');
        $admin->assertSee('images/bijuys-icon.png');
        $admin->assertDontSee('logo-icon.svg');
    }
}
