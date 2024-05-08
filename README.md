# BNU STUDENT WEBSITE

This is a PHP student managment application, designed to allow students to login, edit personal detail, check and add modules.
This application also allows administrators to manage current students and admins and add new students.

## Installation Instructions

1. Run the SQL commands on your database from "_sql/college.dump" to setup the database tables and initial data
2. Download a copy of the repository files and upload them to your FTP server space in a new folder
3. Update "_includes/dbconnect.inc" with your database login credentials
4. Visit the your project folder in a browser and you should see a login screen

## Default Student Login

<a href="https://cw2-student.infinityfreeapp.com/index.php" target="_blank">Student Panel</a>


- Student ID: 20000000
- Password: test

## Default Admin Login


<a href="https://cw2-student.infinityfreeapp.com/admin/index.php" target="_blank">Admin Panel</a>
- Student ID: admin
- Password: test


## What does this web app demonstrate?

- how to use mysqli_ functions to connect to MySQL database
- how you can organise your files and folders in your project (there is no one correct way, but this is one way!)
- how to implement user authentication (login) using the PHP password_verify() function
- how to generate a secure hash of a password (see password_hash.php)
- how to implement a basic templating system (this, in turn, demonstrates how to separate business logic from the presentation layer)
- how to perform redirects using the PHP header() function
- how to implement $_SESSION and check that a user is logged in
- how to use PHP functions and how to properly document your functions using PHP comments (see _includes/functions.inc)


