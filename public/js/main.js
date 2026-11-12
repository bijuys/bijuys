/**
 * Main JavaScript File for Personal Website
 * Handles theme toggling, mobile navigation, project filtering, and form submission.
 */

document.addEventListener('DOMContentLoaded', () => {
  // -------------------------------------------------------------------------
  // 1. Theme Management (Light / Dark Mode)
  // -------------------------------------------------------------------------
  const themeToggle = document.getElementById('theme-toggle');
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)');

  // Determine initial theme
  const getStoredTheme = () => localStorage.getItem('site-theme');
  const setStoredTheme = (theme) => localStorage.setItem('site-theme', theme);

  const applyTheme = (theme) => {
    document.documentElement.setAttribute('data-theme', theme);
    if (themeToggle) {
      themeToggle.setAttribute(
        'aria-label',
        theme === 'dark' ? 'Switch to light mode' : 'Switch to dark mode'
      );
    }
  };

  const initialTheme = getStoredTheme() || (prefersDark.matches ? 'dark' : 'light');
  applyTheme(initialTheme);

  if (themeToggle) {
    themeToggle.addEventListener('click', () => {
      const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      applyTheme(newTheme);
      setStoredTheme(newTheme);
    });
  }

  // Listen to OS theme changes if user hasn't explicitly set a preference
  prefersDark.addEventListener('change', (e) => {
    if (!getStoredTheme()) {
      applyTheme(e.matches ? 'dark' : 'light');
    }
  });

  // -------------------------------------------------------------------------
  // 2. Mobile Navigation Toggle
  // -------------------------------------------------------------------------
  const mobileToggle = document.getElementById('mobile-nav-toggle');
  const siteNav = document.getElementById('site-nav');

  if (mobileToggle && siteNav) {
    const toggleNav = (open) => {
      const shouldOpen = open !== undefined ? open : !siteNav.classList.contains('is-open');
      siteNav.classList.toggle('is-open', shouldOpen);
      mobileToggle.setAttribute('aria-expanded', String(shouldOpen));
      mobileToggle.setAttribute(
        'aria-label',
        shouldOpen ? 'Close navigation menu' : 'Open navigation menu'
      );
    };

    mobileToggle.addEventListener('click', () => toggleNav());

    // Close when clicking nav links
    siteNav.querySelectorAll('.nav-link').forEach((link) => {
      link.addEventListener('click', () => toggleNav(false));
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && siteNav.classList.contains('is-open')) {
        toggleNav(false);
        mobileToggle.focus();
      }
    });

    // Close when clicking outside header
    document.addEventListener('click', (e) => {
      const header = document.querySelector('.site-header');
      if (
        siteNav.classList.contains('is-open') &&
        header &&
        !header.contains(e.target)
      ) {
        toggleNav(false);
      }
    });
  }

  // -------------------------------------------------------------------------
  // 3. Project Filter Tabs (Work Page)
  // -------------------------------------------------------------------------
  const filterButtons = document.querySelectorAll('.filter-btn');
  const projectCards = document.querySelectorAll('.project-card');

  if (filterButtons.length > 0 && projectCards.length > 0) {
    filterButtons.forEach((btn) => {
      btn.addEventListener('click', () => {
        // Update active filter button
        filterButtons.forEach((b) => b.classList.remove('active'));
        btn.classList.add('active');

        const category = btn.getAttribute('data-filter');

        projectCards.forEach((card) => {
          const cardCategories = card.getAttribute('data-category')?.split(' ') || [];
          if (category === 'all' || cardCategories.includes(category)) {
            card.style.display = 'flex';
            card.style.opacity = '1';
          } else {
            card.style.display = 'none';
            card.style.opacity = '0';
          }
        });
      });
    });
  }

  // -------------------------------------------------------------------------
  // 4. Contact Form Handling & Validation
  // -------------------------------------------------------------------------
  const contactForm = document.getElementById('contact-form');
  const formStatus = document.getElementById('form-status');

  if (contactForm) {
    // Reset status on typing in any input
    contactForm.querySelectorAll('input, textarea, select').forEach((field) => {
      field.addEventListener('input', () => {
        if (formStatus && formStatus.classList.contains('is-error')) {
          formStatus.style.display = 'none';
          formStatus.className = 'form-status';
        }
      });
    });

    contactForm.addEventListener('submit', (e) => {
      e.preventDefault();

      // Check form validity
      if (!contactForm.checkValidity()) {
        const firstInvalid = contactForm.querySelector(':invalid');
        if (firstInvalid) {
          firstInvalid.focus();
        }
        if (formStatus) {
          formStatus.textContent = 'Please fill out all required fields correctly.';
          formStatus.className = 'form-status is-error';
          formStatus.style.display = 'block';
        }
        return;
      }

      // Simulate submission loading state
      const submitBtn = contactForm.querySelector('button[type="submit"]');
      const originalText = submitBtn ? submitBtn.innerHTML : 'Send Message';

      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
          <svg style="animation: spin 1s linear infinite; width: 1.15rem; height: 1.15rem;" fill="none" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" style="opacity: 0.25;"></circle>
            <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          Sending...
        `;
      }

      setTimeout(() => {
        // Form submitted successfully
        contactForm.reset();
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalText;
        }

        if (formStatus) {
          formStatus.textContent = 'Thank you! Your message has been received. I will get back to you shortly.';
          formStatus.className = 'form-status is-success';
          formStatus.style.display = 'block';
          formStatus.focus();
        }
      }, 850);
    });
  }

  // -------------------------------------------------------------------------
  // 5. Update Current Year in Footer
  // -------------------------------------------------------------------------
  const yearElement = document.getElementById('current-year');
  if (yearElement) {
    yearElement.textContent = new Date().getFullYear();
  }
});

// Inline keyframe animation for the loader
const styleSheet = document.createElement('style');
styleSheet.textContent = `@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }`;
document.head.appendChild(styleSheet);
