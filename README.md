# Project Management System (PMS)

This project is a web-based Project Management System (PMS) developed using Laravel. It provides a platform for managing projects, tasks, team members, and more.

## Features

- **Project Creation**: Create new projects with detailed information such as name, description, start date, end date, etc.
- **Task Management**: Manage tasks within projects, assign tasks to team members, set deadlines, and track progress.
- **Team Collaboration**: Collaborate with team members by assigning roles and responsibilities.
- **Project Dashboard**: View an overview of project status, upcoming tasks, and other key metrics on the project dashboard.
- **User Authentication**: Secure user authentication and authorization system to ensure only authorized users can access the system.

## Installation

1. Clone the repository:
git clone https://github.com/Umair-28/PMS.git


2. Install dependencies:
   
cd project-directory
composer install
npm install


3. Set up environment variables:
- Rename `.env.example` to `.env` and configure database settings, mail settings, etc.
- Generate an application key:
  ```
  php artisan key:generate
  ```

4. Run migrations and seed the database:
   
  php artisan migrate --seed

5. Start the development server:
 
 php artisan serve

6. Access the application in your web browser at `http://localhost:8000`.

## Usage

- Register an account or use the default admin account created during seeding.
- Route to access login and signup page `http://localhost:8000/login` AND `http://localhost:8000/signup`
- Log in and start managing projects, tasks, and team members. 
