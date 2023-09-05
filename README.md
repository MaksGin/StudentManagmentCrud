## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Setup](#setup)

## General info
My app named Student Management Crud also can be called mini School Diary Management System. 
It's  a web application designed to facilitate efficient school administration and communication among students, teachers, and administrators. 
The application serves as a digital diary, offering a range of features tailored to the specific needs of each user role.

### Features
-  Administrator Dashboard: The admin has complete control over student management, allowing the addition, modification, and deletion of student profiles.
  Additionally, administrators can:
    -  Create user accounts for teachers and students, providing them access to the system.
    -  Assign teachers to specific classes, enabling effective class management.
    - Create custom roles and permissions using the spatie/laravel-permission package, ensuring fine-grained control over user access and actions.

Login Panel

![image](https://github.com/MaksGin/StudentManagmentCrud/assets/26302413/dd2b22c0-072b-4e5a-9022-881d063e5d0f)


Administrator Panel

![image](https://github.com/MaksGin/StudentManagmentCrud/assets/26302413/32359f9d-cfad-4ca3-8e9f-bccd4e003afd)

* Teacher Functions: Teachers, logged in as class supervisors, have the ability to record and manage student grades, providing a seamless way to track academic progress.

Teacher Panel

![image](https://github.com/MaksGin/StudentManagmentCrud/assets/26302413/f24bbbde-8247-49a4-92a6-3c0d43ec419c)


Rating view:

![image](https://github.com/MaksGin/StudentManagmentCrud/assets/26302413/871ce24e-65ab-49b3-a375-658ec75c5eff)


* Student Interface: Students can access their individual profiles to view their grades in individual subjects and their information.

Student Panel

![image](https://github.com/MaksGin/StudentManagmentCrud/assets/26302413/25b98c0c-de42-468e-b4a2-8f8868470c74)

* Class Calendar: Powered by the fullcalendar package, is available to all users. It enables them to schedule and view events, ensuring better organization.
All events are saved to the database

Calendar View

![image](https://github.com/MaksGin/StudentManagmentCrud/assets/26302413/76b03619-f3c0-4d4b-93fa-8f22f843fe41)

## Technologies
Project is created with:
* Bootstrap 5.2.3
* PHP 8.2.4
* Laravel 10.15.0
* spatie/laravel-permission package for handling user roles and permissions
* fullCalendar package
	
## Setup
- PHP (version >= 8.2.4)
- composer
- Node.js and npm

Instructions: 
1. Clone the repository on your local environment
   
```
$ git clone [<repository-url>](https://github.com/MaksGin/StudentManagmentCrud.git)
$ cd folder-name
```

2. Install dependencies (use composer to install php dependecies and npm to install js dependencies)
   
```
composer install
npm install
```

3. Create an .env file and copy the entire contents of the env.example file to it

Update the file with the appropriate settings, such as data for the database, API keys, etc. Link to the documentation: https://laravel.com/docs/10.x/configuration#introduction

Generate app key:
```
php artisan key:generate
```

4. Run Migrations and Seed Data: Execute database migrations and seed sample data.
   
```
php artisan migrate
php artisan db:seed
```

5. Start the server
   
```
php artisan serve
```

6. Open the browser and navigate to
   http://localhost:8000 to see application in action.
