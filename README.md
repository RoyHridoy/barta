## Demo
[Live link](https://barta.royhridoy.me/)

## Features
- User Registration (with flash message)
- User Login (with remember me)
- Password Change (different url)
- Upload Profile Picture (live avatar view when uploading and deleted user's old avatar (if any))
- Make Blade Components

## How to install?
```bash
composer install
cp .env.example .env
php artisan migrate
php artisan key:generate
php artisan storage:link
php artisan serve

# in a separate terminal tab
npm install && npm run dev
```