# Motohub Developer Manual

## Folder Structure

The project is divided into two main folders. The **public** folder contains all the data that the client is going to see. The **app** folder contains all the backend related files.

## Config File Location

Path: {rootDirectory}/app/core/config.php

## CMS

The CMS can be accessed over the route /admin.

## Email Service

Used for:
Contact Form:&emsp;{ROOT}/public/home/contact
Password Reset:&emsp;{ROOT}/public/resetpwd

For testing purposes a mail testing service is being used. Here we use [MailTrap](https://mailtrap.io/). You can log in and see mails from all accounts used in this application. Its main purpose is to be able to change the password if forgotten.

## CRUD Motorcycles

Use admin credentials to log in as admin. Go to /admin/pages or visit the page via the dropdown in the top right of the screen. Use crud operations for the motorcycles page. There is no confirmation popup window yet.

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
