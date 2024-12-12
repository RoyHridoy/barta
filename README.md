# Barta
Barta is a dynamic social application built with Laravel, designed to enable seamless user interaction through posts, comments, and likes. With a focus on performance and usability, Barta provides real-time updates, advanced search capabilities, and comprehensive user profile management.

## ✨ Features
### Core Features
- **User Authentication & Authorization**: Secure login, registration, and email verification.
- **Post Creation (Barta)**: Users can create posts with optional photos.
- **Nested Commenting System**: Two-level replies to enhance discussions.
- **Redis-Powered Like System**: Efficient and scalable implementation for likes.
- **Real-Time Notifications**: Powered by Laravel Reverb for in-app and email notifications.
- **Profile Picture Management**: Upload and update avatars with automatic deletion of old ones.
- **User Profiles**: View personal profiles or explore others' profiles, complete with post summaries and statistics.
- **Search Functionality**: Find users or bartas using usernames, full names, or post titles.
- **Full-Image View**: Show full-sized images on post detail pages.

### Performance and Usability Enhancements
- **Optimized Query Handling**: Designed to reduce database queries for faster performance.
- **Infinite Scrolling**: Load posts and comments dynamically with enhanced performance.
- **Seamless CRUD Operations**: All create, read, update, and delete actions are implemented without page reloads.
- **Real-Time Updates**: Automatic datetime updates without requiring a refresh.
- **Image Management**: Edit, update, and upload images with live previews.

## 💻 Technologies Used
- **Backend**: Laravel 11.x, Redis, Laravel Reverb for Websockets
- **Frontend**: Livewire, TailwindCSS
- **Queue Handling**: database-powered queue workers for stability

## 🚀 Installation Guide
### Prerequisites
- Ensure a **Redis server** is running locally or in your production environment.
- Configure a **mail server** (e.g., Mailpit for local or SMTP for production) for email verification.

### Steps
1. Clone the repository
```bash
git clone https://github.com/RoyHridoy/barta.git
cd barta
```

2. Install dependencies
```bash
composer install
npm install
```

3. Configure environment variables
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure `.env`
- Update database settings.
- Set `REDIS_CLIENT` to either `predis` or `phpredis`
```bash
REDIS_CLIENT=predis
# or
REDIS_CLIENT=phpredis
```
- Configure mail settings.

5. Run migrations and seed the database:
```bash
php artisan migrate
php artisan db:seed
```

6. Set up storage:
```bash
php artisan storage:link
```

7. Start the development server:
```bash
php artisan serve
```

8. Start asset compilation:
```bash
npm run dev
```

10. Start Services:
```bash
# Install and start Laravel Reverb for Websockets
php artisan reverb:install
php artisan reverb:start

# Start the queue worker
php artisan queue:work
```

# 🌐 Demo
### Verified User
After seeding the database, you can log in with the following credentials:
- Email: `jhon@doe.com`
- Password: `password`

# 📝 Special Notes
1. **Redis Client**: Ensure predis or phpredis is installed and configured.
2. **Mail Server**: A running mail server is necessary for user email verification.

# Contributing
Contributions are welcome! Feel free to fork the repository and create a pull request with your improvements.
