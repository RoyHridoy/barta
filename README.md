## Scroll to load bartas
- Load Posts, Comments by Scrolling **performance measures**
- **Comment Reply (2 level)** feature Implemented
- **All CRUD implemented without page refresh or navigate**
- **user Profile with summary and personal bartas**
- View **other user's profile** with summary and bartas
- Barta and Profile **image edit, update, and upload with live view**
- Implement User **Email Verification**
- In show page, full image has shown

## Features
- User **authentication**, **authorization**, **email verification** and upload Profile Picture
- User Can Create barta (using photo is optional)
- Comment and Comment reply feature in barta
- live view when uploading and deleted user's old avatar (if any)
- user's profile view and show other user's posts with statistics
- Search using username, full name or a barta title

## How to install?
After Cloning the repository

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

### You have to ensure a **mail server running** in local environment or configure a mail server in production otherwise user verification is not possible

# seed data
```bash
php artisan db:seed
```
