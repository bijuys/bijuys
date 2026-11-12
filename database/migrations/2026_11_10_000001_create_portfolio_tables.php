<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Site Settings table
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // 2. Projects table
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('fullstack'); // fullstack, frontend, design, etc.
            $table->string('tags')->nullable(); // comma-separated or json
            $table->text('description');
            $table->text('body')->nullable();
            $table->string('badge_text')->nullable();
            $table->string('live_url')->nullable();
            $table->string('github_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 3. Skills table
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->default('Frontend'); // Frontend, Backend & Data, DevOps & Cloud, Design & Workflow
            $table->integer('proficiency')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 4. Experiences table (Timeline)
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->string('company');
            $table->string('location')->nullable();
            $table->string('period'); // e.g. "2023 - Present"
            $table->text('description');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 5. Services / Capabilities table
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('icon')->nullable(); // SVG code or icon name
            $table->text('description');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 6. Contact Messages table
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('subject');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('services');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('settings');
    }
};
