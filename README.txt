
Project Title:-Registration System

Project Description

The proposed registration system gathers user registration information, and a user is only active after having his or her email verified.
User must successfully complete two-factor authentication while logging in.
The undertaking includes password guidelines, including password combinations (8 characters, alphanumeric, upper-lower case and special characters).

Password expiration, preventing password repetition, and other features are additional features.
PHP has been used for the backend programming, and HTML5, CSS3, and JavaScript are supported for the user interface.


Installation Process

step 1:- Install XAMPP in you device
step 2:- Unzip the provided folder with software such as WinRAR, 7-Zip, PeaZip, etc.
step 3:- copy/move unzipped folder inside htdocs folder of xampp folder.


Running the Project

step 1:- run the XAMPP controller and start apache and MySQL
step 2:- follow the link http://localhost:8080/phpmyadmin/ and create database named 'registertable'.
step 3:- create tables users and passwords under the structure given below:
	users:- uid int Auto Increment,  id int(1000), username varchar(255), email varchar(255),password varchar(255), verificationkey(255), is_validated int, date(255)
	password:email varchar(255), password varchar(255)
step 3:- follow the link http://127.0.0.1/login_register_form/SignUp.php to start with registration process.

If you face any problem while running this project please contact at samundradevkota@ismt.edu.np 