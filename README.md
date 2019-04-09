## User and Role Management API
> Primex technical test with Lumen Framework - User and Role Management API
> Last edited by Ryan Zeng 9 April. 2019

### Getting Started
This project is built based on Lumen Framework and Mysql. These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

#### Prerequisites
What things you need to install to run the project and how to install them.
````
- Lumen Framework
- Mysql environment (MAMP)
````
### Installing Project
* Cloning this repository and go to the root folder, run the following commands:
````
- git clone https://github.com/ryanzzeng/primex.git
- composer install
- cp .env.local.test .env
````
* Update the database information in .env file
````
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=primex
- DB_USERNAME=root
- DB_PASSWORD=root
- DB_SOCKET=/Applications/MAMP/tmp/mysql/mysql.sock
````

* Run the following command for database migration and sample data population
````
- php artisan migrate
- php artisan db:seed
````

* Run the project,the base api url(version 1) will be http://localhost:8000/v1/users
````
- php -S localhost:8000 -t public
````

### Unit Test for User Api
* In project repository folder, run the following commands to Test all the API.
* This section will test all the api for successful request  and test the exception situation.
````
vendor/bin/phpunit
````

## Authors

* **Ryan Zeng**
