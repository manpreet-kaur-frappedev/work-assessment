# Laravel Roles & Permissions System

## Manpreet Kaur (mk626109@gmail.com)

### Steps to Local Setup

1. git clone
2. composer install
3. copy .env.example to .env and replace the DB credentials acc. to your setup
4. run `php artisan migrate`
5. run `php artisan db:seed PermissionSeeder`
6. run `php artisan serve`
7. Once the #6 is completed, Open http://localhost:8000 in your browser
8. Register as Admin
9. Create Roles, attach permissions as per your liking
10. Create Multiple Users with variety of roles attached to each.
11. See the Role/Permissions in effect by logging-in into each account and performing operations
