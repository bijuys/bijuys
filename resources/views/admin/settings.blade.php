@extends('admin.layout')

@section('title', 'Site Information & Bio')
@section('page_title', 'Edit Site Information & Content')

@section('content')
  <div class="admin-card">
    <div class="admin-card-header">
      <div>
        <h2 class="admin-card-title">Content & Brand Settings</h2>
        <p style="color: var(--admin-muted); font-size: 0.875rem; margin-top: 0.25rem;">
          Update texts, personal bio, contact numbers, and social URLs across Bijuys.
        </p>
      </div>
    </div>

    <!-- Tab Navigation -->
    <div class="tab-nav">
      <button type="button" class="tab-btn active" onclick="switchTab('general', this)">General & Brand</button>
      <button type="button" class="tab-btn" onclick="switchTab('hero', this)">Hero Section</button>
      <button type="button" class="tab-btn" onclick="switchTab('about', this)">About & Bio</button>
      <button type="button" class="tab-btn" onclick="switchTab('contact', this)">Contact & Socials</button>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Tab 1: General & Brand -->
      <div id="tab-general" class="tab-pane active">
        <div style="background: var(--admin-bg); border: 1px solid var(--admin-border); border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1.25rem;">
          <img class="logo-dark" src="{{ asset('images/bijuys-logo-dark.png') }}" alt="Active Bijuys Name Logo" style="height: 48px; width: auto; max-width: 180px; object-fit: contain;">
          <img class="logo-light" src="{{ asset('images/bijuys-logo-light.png') }}" alt="Active Bijuys Name Logo" style="height: 48px; width: auto; max-width: 180px; object-fit: contain;">
          <div>
            <div style="font-weight: 700; font-size: 0.95rem; color: var(--admin-text);">Active Brand Logo: Bijuys Signature Name Mark</div>
            <div style="font-size: 0.8rem; color: var(--admin-muted);">Custom name logo with integrated code brackets (&lt;/&gt;) and subtitle, rendered across public site header, footer, admin panel, and login screen.</div>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
          <div class="form-group">
            <label for="site_name" class="form-label">Site Name (Brand)</label>
            <input type="text" id="site_name" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? 'Bijuys' }}" required>
            <span class="form-help">Appears in header logo, footer, and page titles.</span>
          </div>

          <div class="form-group">
            <label for="owner_name" class="form-label">Full Name</label>
            <input type="text" id="owner_name" name="owner_name" class="form-control" value="{{ $settings['owner_name'] ?? 'Biju Yohannan' }}" required>
            <span class="form-help">Your display name across the site.</span>
          </div>
        </div>

        <div class="form-group">
          <label for="owner_title" class="form-label">Professional Role / Title</label>
          <input type="text" id="owner_title" name="owner_title" class="form-control" value="{{ $settings['owner_title'] ?? 'Senior Full-Stack Engineer & Product Designer' }}" required>
          <span class="form-help">e.g., Senior Full-Stack Engineer & Product Designer</span>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
          <div class="form-group">
            <label for="location" class="form-label">Location</label>
            <input type="text" id="location" name="location" class="form-control" value="{{ $settings['location'] ?? 'San Francisco, CA (Remote Friendly)' }}">
          </div>

          <div class="form-group">
            <label for="availability" class="form-label">Availability Status</label>
            <input type="text" id="availability" name="availability" class="form-control" value="{{ $settings['availability'] ?? 'Open to Projects' }}">
          </div>
        </div>
      </div>

      <!-- Tab 2: Hero Section -->
      <div id="tab-hero" class="tab-pane">
        <div class="form-group">
          <label for="hero_badge" class="form-label">Hero Badge Banner</label>
          <input type="text" id="hero_badge" name="hero_badge" class="form-control" value="{{ $settings['hero_badge'] ?? 'Available for freelance & full-time roles' }}">
        </div>

        <div class="form-group">
          <label for="hero_title" class="form-label">Hero Headline</label>
          <input type="text" id="hero_title" name="hero_title" class="form-control" value="{{ $settings['hero_title'] ?? 'Crafting fast, intuitive & human-centered web experiences.' }}" required>
          <span class="form-help">Main title on the homepage hero.</span>
        </div>

        <div class="form-group">
          <label for="hero_subtitle" class="form-label">Hero Subtitle</label>
          <textarea id="hero_subtitle" name="hero_subtitle" class="form-control" rows="3" required>{{ $settings['hero_subtitle'] ?? '' }}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; margin-top: 1.5rem;">
          <div class="form-group">
            <label for="stat_experience" class="form-label">Years of Experience</label>
            <input type="text" id="stat_experience" name="stat_experience" class="form-control" value="{{ $settings['stat_experience'] ?? '7+' }}">
          </div>

          <div class="form-group">
            <label for="stat_projects" class="form-label">Projects Completed</label>
            <input type="text" id="stat_projects" name="stat_projects" class="form-control" value="{{ $settings['stat_projects'] ?? '45+' }}">
          </div>

          <div class="form-group">
            <label for="stat_satisfaction" class="form-label">Client Satisfaction</label>
            <input type="text" id="stat_satisfaction" name="stat_satisfaction" class="form-control" value="{{ $settings['stat_satisfaction'] ?? '99%' }}">
          </div>
        </div>
      </div>

      <!-- Tab 3: About & Bio -->
      <div id="tab-about" class="tab-pane">
        <!-- Bio Image Upload Card -->
        <div style="background: var(--admin-bg); border: 2px dashed var(--admin-border); border-radius: 12px; padding: 1.75rem; margin-bottom: 2rem; display: flex; align-items: center; gap: 2rem; flex-wrap: wrap;">
          <div style="position: relative; flex-shrink: 0;">
            <img 
              id="bio-image-preview" 
              src="{{ $bioImageUrl }}" 
              alt="Bio Portrait Preview" 
              style="width: 110px; height: 110px; border-radius: 20px; object-fit: cover; border: 3px solid var(--admin-primary); box-shadow: 0 8px 24px rgba(99, 102, 241, 0.25); display: block;"
            >
            <span style="position: absolute; bottom: -4px; right: -4px; background: #10b981; width: 18px; height: 18px; border-radius: 50%; border: 3px solid var(--admin-card);" title="Active Bio Photo"></span>
          </div>

          <div style="flex: 1; min-width: 260px;">
            <label for="bio_image" class="form-label" style="font-weight: 700; font-size: 1.05rem; margin-bottom: 0.25rem;">
              Profile &amp; Bio Picture
            </label>
            <p style="color: var(--admin-muted); font-size: 0.85rem; margin-bottom: 1rem; line-height: 1.5;">
              Upload your photo to display across the site—including the About story card, Home page hero visual, and article author badges. Supports PNG, JPG, WebP, SVG (Max 5MB).
            </p>

            <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
              <input 
                type="file" 
                id="bio_image" 
                name="bio_image" 
                class="form-control @error('bio_image') is-invalid @enderror" 
                accept="image/*" 
                onchange="previewBioImage(this)"
                style="max-width: 340px;"
              >
              <label style="display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: var(--admin-muted); cursor: pointer;">
                <input type="checkbox" name="remove_bio_image" value="1">
                <span>Reset to default portrait</span>
              </label>
            </div>
            @error('bio_image')
              <div style="color: #ef4444; font-size: 0.85rem; margin-top: 0.5rem;">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="form-group">
          <label for="about_lead" class="form-label">About Page Headline</label>
          <input type="text" id="about_lead" name="about_lead" class="form-control" value="{{ $settings['about_lead'] ?? 'Bridging technical precision with thoughtful design.' }}" required>
        </div>

        <div class="form-group">
          <label for="about_bio_1" class="form-label">Introduction Paragraph 1</label>
          <textarea id="about_bio_1" name="about_bio_1" class="form-control" rows="3" required>{{ $settings['about_bio_1'] ?? '' }}</textarea>
        </div>

        <div class="form-group">
          <label for="about_bio_2" class="form-label">Introduction Paragraph 2</label>
          <textarea id="about_bio_2" name="about_bio_2" class="form-control" rows="3" required>{{ $settings['about_bio_2'] ?? '' }}</textarea>
        </div>

        <div class="form-group">
          <label for="about_bio_3" class="form-label">Introduction Paragraph 3 (Hobbies / Personal)</label>
          <textarea id="about_bio_3" name="about_bio_3" class="form-control" rows="2">{{ $settings['about_bio_3'] ?? '' }}</textarea>
        </div>
      </div>

      <!-- Tab 4: Contact & Socials -->
      <div id="tab-contact" class="tab-pane">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
          <div class="form-group">
            <label for="contact_email" class="form-label">Public Inquiries Email</label>
            <input type="email" id="contact_email" name="contact_email" class="form-control" value="{{ $settings['contact_email'] ?? 'biju@bijuys.com' }}" required>
          </div>

          <div class="form-group">
            <label for="contact_phone" class="form-label">Phone Number (Optional)</label>
            <input type="text" id="contact_phone" name="contact_phone" class="form-control" value="{{ $settings['contact_phone'] ?? '' }}">
          </div>
        </div>

        <div class="form-group">
          <label for="github_url" class="form-label">GitHub Profile URL</label>
          <input type="url" id="github_url" name="github_url" class="form-control" value="{{ $settings['github_url'] ?? 'https://github.com' }}">
        </div>

        <div class="form-group">
          <label for="linkedin_url" class="form-label">LinkedIn Profile URL</label>
          <input type="url" id="linkedin_url" name="linkedin_url" class="form-control" value="{{ $settings['linkedin_url'] ?? 'https://linkedin.com' }}">
        </div>

        <div class="form-group">
          <label for="twitter_url" class="form-label">Twitter / X URL</label>
          <input type="url" id="twitter_url" name="twitter_url" class="form-control" value="{{ $settings['twitter_url'] ?? 'https://twitter.com' }}">
        </div>
      </div>

      <div style="border-top: 1px solid var(--admin-border); padding-top: 1.5rem; margin-top: 2rem; display: flex; justify-content: flex-end;">
        <button type="submit" class="btn btn-primary" style="padding: 0.75rem 2rem;">
          Save All Changes
        </button>
      </div>
    </form>
  </div>
@endsection

@push('scripts')
<script>
  function switchTab(tabId, btn) {
    document.querySelectorAll('.tab-pane').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
    
    document.getElementById('tab-' + tabId).classList.add('active');
    btn.classList.add('active');
  }

  function previewBioImage(input) {
    const preview = document.getElementById('bio-image-preview');
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endpush
