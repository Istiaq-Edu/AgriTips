<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

# কৃষি টিপস (Agricultural Tips)

A Laravel 12 + Vite + Tailwind CSS (v4) web app for sharing agricultural advice in Bangla. This guide explains how to run the project locally on Windows, macOS, or Linux.

## Requirements

- PHP 8.2+
- Composer 2+
- Node.js 18+ and npm 9+
- SQLite (default) or MySQL

## 1) Clone and enter project

Clone or download the repository, then open the `AgriTips/` folder in your terminal/IDE.

```
# Example
# git clone https://github.com/<your-username>/agricultural-tips.git
# cd agricultural-tips/AgriTips
```

## 2) Install PHP dependencies

```
composer install
```

## 3) Create .env and app key

```
copy .env.example .env   # Windows PowerShell/cmd
# or: cp .env.example .env

php artisan key:generate
```

## 4) Configure database

Choose one of the following:

### Option A: SQLite (quick start)

Edit `.env` and set:

```
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

Create the SQLite file (if missing):

```
# Windows PowerShell
ni database/database.sqlite -Force

# macOS/Linux
touch database/database.sqlite
```

### Option B: MySQL (your choice)

1) Create a database and user in MySQL:

```
-- Example SQL
CREATE DATABASE agri_tips CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'agri_user'@'localhost' IDENTIFIED BY 'strong_password_here';
GRANT ALL PRIVILEGES ON agri_tips.* TO 'agri_user'@'localhost';
FLUSH PRIVILEGES;
```

2) Update `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=agri_tips
DB_USERNAME=agri_user
DB_PASSWORD=strong_password_here
```

3) Ensure MySQL is running locally, then run migrations.

Run migrations (for either option):

```
php artisan migrate
```

## 5) Install frontend dependencies

```
npm install
```

## 6) Run the app (choose one)

### Option A: One command (recommended during development)

This uses Composer to run Laravel, queues/logs, and Vite together:

```
composer run dev
```

Open: http://127.0.0.1:8000

### Option B: Two terminals

```
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

## Production build (assets)

```
npm run build
```

You can then serve via your preferred PHP server (e.g., Nginx/Apache, or Laravel Forge).

## Useful commands

- Clear caches:
  - `php artisan cache:clear && php artisan config:clear && php artisan view:clear`
- Run tests:
  - `php artisan test`
- Change dev server port if 8000 is busy:
  - `php artisan serve --port=8001`

## Troubleshooting

- Editor shows CSS warnings like `@source`/`@theme` in `resources/css/app.css`:
  - These are Tailwind v4 directives; the build (Vite) handles them. Warnings can be ignored if `npm run dev` works.
- CSS/JS not updating:
  - Restart `npm run dev` and clear views: `php artisan view:clear`.
- Node version errors:
  - Ensure Node 18+ (`node -v`).
- Migration errors with SQLite:
  - Confirm `.env` uses `DB_CONNECTION=sqlite` and the `database/database.sqlite` file exists.
