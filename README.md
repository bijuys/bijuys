# Bijuys — Personal Portfolio & CMS (PHP Laravel)

A full-stack personal portfolio and dynamic Content Management System (CMS) engineered with **PHP 8.3** and **Laravel**.

- **Site Name**: Bijuys
- **Author**: Biju Yohannan
- **Default Database**: SQLite (zero-config, self-contained)

---

## 🌟 Key Features

### 🖥️ Public Portfolio Pages
1. **Home (`/`)**:
   - Hero header with dynamic headline, subtitle, real-time stats, and avatar card.
   - Services / Capabilities grid.
   - Selected featured projects preview.
   - Call-to-action banner.
2. **About (`/about`)**:
   - Personal background narrative and mission statement.
   - Dynamic toolkit skills grouped by category (Frontend, Backend & Data, DevOps & Cloud, Design & Workflow).
   - Interactive career milestone timeline.
   - Work philosophy & values.
3. **Work (`/work`)**:
   - Interactive filter tabs (**All**, **Full-Stack**, **Frontend**, **Design**).
   - Dynamic project showcase cards with live demo links, repository URLs, tags, and category badges.
   - 4-step development methodology breakdown.
4. **Blog (`/blog`) & Single Article (`/blog/{slug}`)**:
   - Article catalog with keyword search and category pills.
   - Full article view with reading time, publication dates, author card, related articles, and tags.
   - Homepage preview featuring the latest technical insights.
5. **Contact (`/contact`)**:
   - Contact details (email, phone, location, availability, social links).
   - Fully accessible, CSRF-protected contact form that saves incoming messages to the database.
   - Frequently Asked Questions (FAQ) section.

### ⚙️ Backend Admin Dashboard (`/admin`)
- **Theme Switcher (Light / Dark Mode)**:
  - Clean, modern **Light Theme** as the default SaaS styling.
  - Interactive Theme Toggle in the admin topbar (and login page) with persistent choice stored in `localStorage`.
- **Dashboard Overview (`/admin`)**:
  - Key metrics (total projects, blog articles, skills, timeline items, inquiries, unread messages).
  - Quick actions and recent message inbox preview.
- **Site Information & Bio (`/admin/settings`)**:
  - Update Brand Name ("Bijuys"), Owner Name ("Biju Yohannan"), Role/Title, Location, Availability.
  - Modify Hero headline, subtitle, and stats (Years of experience, Projects completed, Client satisfaction).
  - Update About page story and bio paragraphs.
  - Configure public contact email, phone, and social media handles (GitHub, LinkedIn, Twitter/X).
- **Projects Management (`/admin/projects`)**:
  - Full CRUD: Add, edit, reorder, feature on homepage, or delete projects.
- **Blog Management (`/admin/posts`)**:
  - Full CRUD: Draft or publish articles, set reading time, categories, tags, excerpts, and rich body content.
- **Skills Management (`/admin/skills`)**:
  - Full CRUD: Add, edit, categorize, and reorder technical skills.
- **Career Timeline (`/admin/experiences`)**:
  - Full CRUD: Manage career milestone timeline entries.
- **Services Management (`/admin/services`)**:
  - Full CRUD: Manage capabilities and service offerings.
- **Inquiries Inbox (`/admin/messages`)**:
  - View incoming messages submitted through the contact form.
  - Mark messages as Read/Unread or delete them.

---

## 🔐 Default Admin Credentials

- **Login URL**: [http://localhost:8000/admin/login](http://localhost:8000/admin/login)
- **Email**: `admin@bijuys.com`
- **Password**: `password`

*(You can change the email and password anytime via database or tinker).*

---

## 🚀 How to Run the Application

Laragon includes PHP 8.3 and Composer under `C:\laragon\bin`. To run the application:

```powershell
# 1. Navigate to the project directory
cd "C:\Users\indig\.gemini\antigravity\scratch\bijuys-app"

# 2. Add Laragon's PHP to your current session PATH (if not globally set)
$env:PATH = "C:\laragon\bin\php\php-8.3.16-Win32-vs16-x64;C:\laragon\bin\composer;$env:PATH"

# 3. Start the Laravel development server
php artisan serve
```

Once running:
- Open the public portfolio at: **[http://localhost:8000](http://localhost:8000)**
- Open the admin dashboard at: **[http://localhost:8000/admin](http://localhost:8000/admin)**

---

## 🗄️ Database & Migrations

The database is pre-configured and pre-seeded using SQLite located at `database/database.sqlite`.

If you ever wish to re-seed demo data:
```powershell
php artisan migrate:fresh --seed
```

To switch to MySQL in Laragon, simply adjust `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bijuys
DB_USERNAME=root
DB_PASSWORD=
```
and run `php artisan migrate --seed`.

---

## 🛠️ Setting Active Workspace

To set this Laravel project as your active workspace in Antigravity:
1. Open Antigravity's workspace picker.
2. Select or navigate to:
   ```text
   C:\Users\indig\.gemini\antigravity\scratch\bijuys-app
   ```
