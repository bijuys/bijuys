/**
 * Bijuys Admin Dashboard JavaScript
 * Handles theme toggling, persistence, and UI interactions.
 */

(function () {
  'use strict';

  // Apply theme as early as possible from localStorage (defaults to light)
  const getStoredTheme = () => localStorage.getItem('bijuys-admin-theme') || 'light';
  const setStoredTheme = (theme) => localStorage.setItem('bijuys-admin-theme', theme);

  const applyAdminTheme = (theme) => {
    document.documentElement.setAttribute('data-admin-theme', theme);
    const toggleBtn = document.getElementById('admin-theme-toggle');
    if (toggleBtn) {
      toggleBtn.setAttribute('aria-label', theme === 'dark' ? 'Switch to light mode' : 'Switch to dark mode');
      const label = toggleBtn.querySelector('.admin-theme-text');
      if (label) {
        label.textContent = theme === 'dark' ? 'Light Mode' : 'Dark Mode';
      }
    }
  };

  // Run on DOM load
  document.addEventListener('DOMContentLoaded', () => {
    const currentTheme = getStoredTheme();
    applyAdminTheme(currentTheme);

    const toggleBtn = document.getElementById('admin-theme-toggle');
    if (toggleBtn) {
      toggleBtn.addEventListener('click', () => {
        const activeTheme = document.documentElement.getAttribute('data-admin-theme') || 'light';
        const nextTheme = activeTheme === 'dark' ? 'light' : 'dark';
        applyAdminTheme(nextTheme);
        setStoredTheme(nextTheme);
      });
    }
  });
})();
