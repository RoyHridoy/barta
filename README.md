## Assignment 3 (What I've improved)
- UI and UX improvement
- Search Feature implement
- Custom Pagination Design added
- **user Profile with summary and personal bartas**
- View **other user's profile** with summary and bartas
- Implement Comments in Single Page
- In single page, full barta and full image has shown (**index page is only for highlights**)
- Barta and Profile **image edit, update, and upload with live view**
- **Comment edit, delete without edit, delete page**
- **Identify barta author in comment**

## Features
- User authentication, authorization, and upload Profile Picture (live avatar view when uploading and deleted user's old avatar (if any))
- User Can Create barta using photo
- user's profile view and show user specific posts with statistics
- Comment feature in barta
- Search using username, email or full name

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

# seed data
```bash
php artisan db:seed
```

# Additional Information
Register and login user to create posts, comments and explore all facilities with registered user.
