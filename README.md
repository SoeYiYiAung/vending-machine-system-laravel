# Laravel Vending Machine
A simple vending machine web application built with **Laravel 11** and **PHP 8.2**.  
This project demonstrates product management, user authentication, and purchase transactions.

# Features
- User authentication (login, register, logout)
- Admin product management (CRUD: create, edit, delete)
- Purchase flow for users
- Transaction history
- Role-based access (Admin / User)
- Web UI with Blade templates (full browser experience)
- RESTful API with JWT authentication for external frontend/mobile apps

# Requirements
- PHP 8.2+
- Composer 2+
- MySQL 8+ (or compatible database)
- Laravel 11

# Setup Instructions
- Run composer install: composer install
- Create .env file (copy from example): cp .env.example .env
- Generate app key: php artisan key:generate
- Set up DB in .env (vending_machine)
- Run migrations: php artisan migrate
- Seed test data : php artisan db:seed
- Start server: php artisan serve

# Clone the repository
git clone https://github.com/SoeYiYiAung/vending-machine-system-laravel.git
cd laravel-vending-machine
