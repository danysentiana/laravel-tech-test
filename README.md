<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About This Project

This project is a technical test for a company that i applied for. The project is a simple api that has a CRUD functionality for a user and a user can have multiple posts. The api is built using laravel and uses a mysql database.

## Api Documentation in postman

Setup postman collection and environment

[Postman Collection](https://www.postman.com/universal-crescent-423027/workspace/technical-test-fd/collection/16842792-3a15bf39-abe4-42b4-a02c-41fb6ce5dc45?action=share&creator=16842792)

## Postman Setup

set postman environment variable to local to run the api in the environment i've created

## Project Installation

1. Clone the repo

    ```sh
    git clone

    ```

2. Install composer packages
    ```sh
    composer install
    ```
3. Create a database in mysql
4. Create a .env file and copy the contents of .env.example to it
5. Set the database name, username and password in the .env file
6. Run the migrations
    ```sh
    php artisan migrate
    ```
7. Run the seeder
    ```sh
    php artisan db:seed
    ```
8. Run the project
    ```sh
    php artisan serve
    ```
