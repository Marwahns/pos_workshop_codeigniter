# CodeIgniter 4 Application Starter

<img alt="php" src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"> <img alt="bootstrap" src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white"> <img alt="jquery" src="https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white"> <img alt="codeigniter" src="https://img.shields.io/badge/Codeigniter-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white"> <img alt="css" src="https://img.shields.io/badge/CSS-239120?&style=for-the-badge&logo=css3&logoColor=white"> <img alt="javascript" src="https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E"> 

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

The user guide corresponding to the latest version of the framework can be found
[here](https://codeigniter4.github.io/userguide/).

## Server Requirements

PHP version 7.4 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

## Installation

- Open the `xampp/htdocs` folder and clone this repository to your local machine `git clone https://github.com/Marwahns/pos_workshop_codeigniter.git` command
- Open the `pos_workshop_codeigniter` folder in your code editor, then rename the `env` file to `.env`
- Create a database in mysql, you can use phpmyadmin. Next open the `pos_workshop_codeigniter folder` and open the `env` file then look at the `database.default.database = pos_bengkel` section, change `pos_bengkel` to the name of the database you just created
- Next, open the `database.php` file, adjust the database name to the database name that was previously created
- Open a localhost web server such as (XAMPP, MAMP, LAMPP, etc), then activate Apache and MySQL
- Open terminal/cmd, navigate to the `pos_workshop_codeigniter` folder. Run the `composer install` command. After that, run the following commands incrementally
  ```
  php spark migrate
  php spark db:seed DatabaseSeeder
  php spark serve
  ```
- If there is no problem, then please access the page `http://localhost:8081/` then the login page should appear

## User and Permission

1. Login as Super Admin

- username : superadmin
- password : superadmin

2. Login as Admin

- username : admin
- password : admin

3. Login as Kasir

- username : kasir
- password : kasir
