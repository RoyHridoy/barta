## Assignment 3
- UI and UX improvement when uploading and edit post photo
- Search Feature implement
- Custom Pagination Design added
- Implement Comments in single page (TODO)

#Question
- Should I keep all files in vendor/pagination folders?
## Features
- User Registration (with flash message)
- User Login (with remember me)
- Password Change (different url)
- Upload Profile Picture (live avatar view when uploading and deleted user's old avatar (if any))
- User Can Create Post (optional photo)
- Authorize user can edit, delete post
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
