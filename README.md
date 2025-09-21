Run composer install: composer install
Create .env file (copy from example): cp .env.example .env
Generate app key: php artisan key:generate
Set up DB in .env (vending_machine)
Run migrations: php artisan migrate
Seed test data if you provide a seeder: php artisan db:seed
Start server: php artisan serve