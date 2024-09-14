## Features
- User Registration (with flash message)
- User Login (with remember me)
- Password Change (different url)
- Upload Profile Picture (live avatar view when uploading)
- Make Blade Components

## How to install?
```bash
composer install
cp .env .env.example
php artisan migrate
php artisan generate:key
php artisan serve

# in a separate terminal tab
npm install && npm run dev
```