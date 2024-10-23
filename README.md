## Summary
Open Booking is an open-source service booking platform that allows users to seamlessly book services or order service packages. This backend repository is responsible for managing all core functionalities, including user authentication, service management, booking operations, and package orders.

> Backend API for Mobile App and Dashboard
> - Mobile App Authentication is implemented by [JWT Auth](https://github.com/tymondesigns/jwt-auth)
> - Dashboard Web App Authentication is implemented by [Laravel Sanctum](https://github.com/laravel/sanctum/)
> - Powered by Laravel Octane

## Reference Code Architecture
- [Next Architecture](/app/Next/README.md)
- Parent Reference Classes are in the path [/app/Next](/app/Next/)

## Setup

```
composer install
cp .env.example .env #Don't forget to configure your .env file

# Telescope
php artisan telescope:install

php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link

# customers auth
php artisan jwt:secret

# octane
php artisan octane:install --server=roadrunner


npm install

```

## Run Dev Environment
```
# run dev server
php artisan serve

# run queue workers
php artisan queue:work --queue=send_otp

# run octane 
php artisan octane:start --server=roadrunner
```

## Queues
`send_otp` - for sending OTP via email or sms

## Deployment

### Web Server (nginx)
[Backend Config](/deployment/nginx/backend.conf)

[Dashboard Config](/deployment/nginx/dashboard.conf)

### Supervisor
[OTP Queue](/deployment/supervisor/queue.conf)

[Octane](/deployment/supervisor/octane.conf)

```
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start 
```
