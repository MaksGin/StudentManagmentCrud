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

Administrator Panel
![image](https://github.com/MaksGin/StudentManagmentCrud/assets/26302413/12976ad4-6b3d-4c2a-b965-72ae93257ce2)


* Teacher Functions: Teachers, logged in as class supervisors, have the ability to record and manage student grades, providing a seamless way to track academic progress.

Teacher Panel
![image](https://github.com/MaksGin/StudentManagmentCrud/assets/26302413/d70ca3dd-73b4-4866-b53a-b064008bf8e8)


* Student Interface: Students can access their individual profiles to view their grades in individual subjects and their information.

Student Panel
![image](https://github.com/MaksGin/StudentManagmentCrud/assets/26302413/c13418ac-00d1-4db4-adb7-fc8bc13a2b71)

* Class Calendar: Powered by the fullcalendar package, is available to all users. It enables them to schedule and view events, ensuring better organization.

Calendar View
![image](https://github.com/MaksGin/StudentManagmentCrud/assets/26302413/20d4838c-7ec2-4e9c-9967-e21b9d5e6cc9)

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
