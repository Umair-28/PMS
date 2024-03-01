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
```
git clone https://github.com/Umair-28/PMS.git
```

2. Start Docker containers:
```
 ./vendor/bin/sail up -d
```

3. Install dependencies (if needed):

```
./vendor/bin/sail composer install
```
4. Set up environment variables:

```
Rename .env.example to .env
```

5. Generate an application key:
```
./vendor/bin/sail artisan key:generate
```

6. Run migrations and seed the database:
```
./vendor/bin/sail artisan migrate --seed
```

IF ABOVE DID NOT SEED DATABASE MANUALLY RUN THE SEEDERS

```
./vendor/bin/sail artisan db:seed --class=RoleSeeder
./vendor/bin/sail artisan db:seed --class=PermissionSeeder
./vendor/bin/sail artisan db:seed --class=AdminSeeder
./vendor/bin/sail artisan db:seed --class=LeaderSeeder
./vendor/bin/sail artisan db:seed --class=DeveloperSeeder
```

## Usage

- Register an account or use the default admin account created during seeding.
- Route to access login and signup page `http://0.0.0.0:8000/login` AND `http://0.0.0.0:8000/signup`
- Log in and start managing projects, tasks, and team members. 
