@php
  use App\Models\Setting;
  $siteName = Setting::get('site_name', 'Bijuys');
  $ownerName = Setting::get('owner_name', 'Biju Yohannan');
  $contactEmail = Setting::get('contact_email', 'biju@bijuys.com');
  $contactPhone = Setting::get('contact_phone', '+1 (555) 019-2834');
  $location = Setting::get('location', 'San Francisco, CA • Available Worldwide');
  $githubUrl = Setting::get('github_url', 'https://github.com');
  $linkedinUrl = Setting::get('linkedin_url', 'https://linkedin.com');
  $twitterUrl = Setting::get('twitter_url', 'https://twitter.com');
@endphp

@extends('layouts.app')

@section('title', 'Contact & Inquiries | ' . $ownerName . ' - ' . $siteName)

@section('content')
  <section class="section">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">Get in Touch</span>
        <h1 class="section-title">Let’s Start a Conversation</h1>
        <p class="section-desc">
          Whether you have a specific project in mind, want to discuss a potential partnership, or simply want to say hello, my inbox is always open.
        </p>
      </div>

      <div class="contact-grid">
        <!-- Contact Info Column -->
        <div class="contact-info-card">
          <div>
            <h2 style="font-size: 1.4rem; font-weight: 700; margin-bottom: 0.5rem;">Contact Information</h2>
            <p style="color: var(--text-secondary); font-size: 0.95rem;">
              Fill out the form or reach out directly via email or social channels.
            </p>
          </div>

          <div class="info-item">
            <div class="info-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            </div>
            <div class="info-content">
              <h4>Email</h4>
              <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
            </div>
          </div>

          @if($contactPhone)
            <div class="info-item">
              <div class="info-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              </div>
              <div class="info-content">
                <h4>Phone</h4>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactPhone) }}">{{ $contactPhone }}</a>
              </div>
            </div>
          @endif

          <div class="info-item">
            <div class="info-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div class="info-content">
              <h4>Location</h4>
              <p>{{ $location }}</p>
            </div>
          </div>

          <div class="info-item">
            <div class="info-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="info-content">
              <h4>Response Time</h4>
              <p>Usually within 24 business hours</p>
            </div>
          </div>

          <div style="border-top: 1px solid var(--border-color); padding-top: 1.5rem;">
            <h4 style="font-size: 0.95rem; font-weight: 600; margin-bottom: 0.75rem;">Follow & Connect</h4>
            <div class="social-links">
              @if($githubUrl)
                <a class="social-btn" href="{{ $githubUrl }}" target="_blank" rel="noopener noreferrer" aria-label="GitHub Profile">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"></path><path d="M9 18c-4.51 2-5-2-7-2"></path></svg>
                </a>
              @endif
              @if($linkedinUrl)
                <a class="social-btn" href="{{ $linkedinUrl }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn Profile">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect width="4" height="12" x="2" y="9"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                </a>
              @endif
              @if($twitterUrl)
                <a class="social-btn" href="{{ $twitterUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Twitter Profile">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path></svg>
                </a>
              @endif
            </div>
          </div>
        </div>

        <!-- Contact Form Container -->
        <div class="contact-form-container">
          <h2 style="font-size: 1.4rem; font-weight: 700; margin-bottom: 0.5rem;">Send a Message</h2>
          <p style="color: var(--text-secondary); font-size: 0.95rem; margin-bottom: 1.75rem;">
            Fill in your details below and I'll get back to you shortly.
          </p>

          <!-- Status / Flash Message -->
          @if(session('success'))
            <div class="form-status is-success" style="display: block;" role="status">
              {{ session('success') }}
            </div>
          @endif

          @if($errors->any())
            <div class="form-status is-error" style="display: block;" role="alert">
              <ul style="padding-left: 1.25rem;">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <div id="form-status" class="form-status" role="status" aria-live="polite" tabindex="-1"></div>

          <form id="contact-form" action="{{ route('contact.submit') }}" method="POST">
            @csrf

            <div class="form-group">
              <label for="contact-name" class="form-label">
                Your Full Name <span class="required-indicator" aria-hidden="true">*</span>
              </label>
              <input 
                type="text" 
                id="contact-name" 
                name="name" 
                class="form-input" 
                value="{{ old('name') }}"
                autocomplete="name" 
                enterkeyhint="next"
                required
              >
            </div>

            <div class="form-group">
              <label for="contact-email" class="form-label">
                Email Address <span class="required-indicator" aria-hidden="true">*</span>
              </label>
              <input 
                type="email" 
                id="contact-email" 
                name="email" 
                class="form-input" 
                value="{{ old('email') }}"
                autocomplete="email" 
                autocorrect="off" 
                autocapitalize="none" 
                spellcheck="false" 
                enterkeyhint="next"
                aria-describedby="email-hint"
                required
              >
              <span id="email-hint" class="form-hint">Your email is kept strictly confidential and never shared.</span>
            </div>

            <div class="form-group">
              <label for="contact-subject" class="form-label">
                Project Inquired / Subject <span class="required-indicator" aria-hidden="true">*</span>
              </label>
              <select id="contact-subject" name="subject" class="form-select" required>
                <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Select an option...</option>
                <option value="Full-Stack Web Development" {{ old('subject') == 'Full-Stack Web Development' ? 'selected' : '' }}>Full-Stack Web Development</option>
                <option value="Laravel / API Architecture" {{ old('subject') == 'Laravel / API Architecture' ? 'selected' : '' }}>Laravel / API Architecture</option>
                <option value="UI/UX Design & Prototyping" {{ old('subject') == 'UI/UX Design & Prototyping' ? 'selected' : '' }}>UI/UX Design & Prototyping</option>
                <option value="Performance / Architecture Audit" {{ old('subject') == 'Performance / Architecture Audit' ? 'selected' : '' }}>Performance / Architecture Audit</option>
                <option value="Full-Time / Contract Position" {{ old('subject') == 'Full-Time / Contract Position' ? 'selected' : '' }}>Full-Time / Contract Position</option>
                <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry / Just Saying Hi</option>
              </select>
            </div>

            <div class="form-group">
              <label for="contact-message" class="form-label">
                Project Details / Message <span class="required-indicator" aria-hidden="true">*</span>
              </label>
              <textarea 
                id="contact-message" 
                name="message" 
                class="form-textarea" 
                rows="5" 
                minlength="10" 
                placeholder="Share details about your timeline, scope, and objectives..." 
                required
              >{{ old('message') }}</textarea>
              <span class="form-hint">Minimum 10 characters.</span>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
              Send Message
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ Section -->
  <section class="section section-muted" id="faq">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">FAQ</span>
        <h2 class="section-title">Frequently Asked Questions</h2>
        <p class="section-desc">Quick answers to common questions about working together.</p>
      </div>

      <div class="features-grid">
        <div class="feature-card">
          <h3 class="feature-title">What is your typical project timeline?</h3>
          <p class="feature-desc">
            Timelines vary depending on project complexity. Standard landing pages or portfolio sites take 1–2 weeks, while full-stack web applications and SaaS MVPs typically range between 4 to 8 weeks.
          </p>
        </div>

        <div class="feature-card">
          <h3 class="feature-title">Do you work with clients across different time zones?</h3>
          <p class="feature-desc">
            Yes! I have collaborated with clients across North America, Europe, and Asia. I emphasize async documentation, clear milestones, and flexible overlap hours for team standups.
          </p>
        </div>

        <div class="feature-card">
          <h3 class="feature-title">What does an engagement cost?</h3>
          <p class="feature-desc">
            I work both on fixed-price milestones for well-defined scopes and on weekly/monthly retainers for ongoing development and advisory. Contact me with your project details for an accurate quote.
          </p>
        </div>

        <div class="feature-card">
          <h3 class="feature-title">Can you assist with existing codebases?</h3>
          <p class="feature-desc">
            Absolutely. I frequently help teams refactor legacy applications, improve Lighthouse and Core Web Vitals performance, modernize UI component systems, or resolve technical debt.
          </p>
        </div>
      </div>
    </div>
  </section>
@endsection
