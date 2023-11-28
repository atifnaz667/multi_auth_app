## Laravel Multi-Auth App

This Laravel application demonstrates a Multi-Auth system with three user roles: Admin, Teacher, and Student. The application includes a simple CRUD menu for Courses, where only Admin and Teacher have full CRUD functionality, while Students can only view the courses.

## Dummy Accounts
To explore the application, you can use the following dummy accounts:

Admin:
Email: admin@devbunch.com
Password: 12345678

Teacher:
Email: teacher@devbunch.com
Password: 12345678

Student:
Email: student@devbunch.com
Password: 12345678


## Installation
Follow these steps to set up and run the project locally:


## Install dependencies:

# composer install
Copy the .env.example file to create a new .env file:

# Generate the application key:
php artisan key:generate

# Configure the database connection in the .env file:

DB_CONNECTION=mysql
DB_HOST=your-database-host
DB_PORT=your-database-port
DB_DATABASE=multi_auth_app
DB_USERNAME=root
DB_PASSWORD=

# Run the database migrations:
php artisan migrate

# Seed the database with dummy users:
php artisan db:seed


## Usage
Access the application in your browser.
Log in using one of the provided dummy accounts based on the desired role (Admin, Teacher, or Student).
Features
Multi-Auth System: Admin, Teacher, and Student roles with different access levels.
CRUD Menu: Courses can be created, read, updated, and deleted by Admin and Teacher. Students can only view the courses.
