# Motohub Developer Manual

## Folder Structure

The project is divided into two main folders. The **public** folder contains all the data that the client is going to see. The **app** folder contains all the backend related files.

A custom MVC framework was built for this website. The entry point is at public/index.php which will load app/core/init.php and then load app/core/app.php which is managing the controllers at app/controllers.

The app/core folder also contains base classes for the controllers (Controller.php), the models (Database.php, Model.php) and the config.php file.

The app/models, app/views, app/controllers is standard for the MVC framework.

The app/libs folder contains external libraries.

The app/utility folder contains custom classes for various functionality on the website.

## Config File Location

Path: {ROOT}/app/core/config.php

## CMS

The CMS can be accessed over the route {ROOT}/public/admin.

## Email Service

For testing purposes a mail testing service is being used. Here we use [MailTrap](https://mailtrap.io/). You can log in and see mails from all accounts used in this application. Its main purpose is to be able to change the password if forgotten.

Used for:<br>
Contact Form:&emsp;&emsp;{ROOT}/public/home/contact<br>
Password Reset:&emsp;{ROOT}/public/resetpwd

## CRUD

### Motorcycles

Use admin credentials to log in as admin. Go to {ROOT}/public/admin/pages or visit the page via the dropdown in the top right of the screen. All CRUD operations are available for motorcycles. For deletion a popup window will be shown for confirmation.

### User

Create a new user at {ROOT}/public/home/register or log in the provided user at {ROOT}/public/home/login and go to {ROOT}/user/settings to update the user settings or delete the user. A confirmation popup window will be displayed to confirm the deletion of the user.

All of these links can also be accessed via the navigation.

## Credentials

### Admin Credentials

Login Page:&emsp;{ROOT}/public/admin

username:&emsp;admin<br>
password:&emsp;Admin123!

### User Credentials

Login Page:&emsp;{ROOT}/public/home/login

username:&emsp;user<br>
password:&emsp;User123!

### MailTrap Credentials

Login Page:&emsp;https://mailtrap.io/signin

email:&emsp;&emsp;&emsp;kadir9625+mailtrap@gmail.com<br>
password:&emsp;Admin123!
