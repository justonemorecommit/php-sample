# A simple web app using php

Jackson's 12 hour sample project using PHP

## Requirements

- PHP >= 7.3
- Composer >= 2.1.8

## Tech Stack

- _PHP Dependency Manager_ **Composer**
- _PHP Dependency Injection_ **PHP-DI**
- _Routing_ **Slim**
- _ORM_ **Doctrine**
- _Migration_ **Phinx**
- _Template_ **Twig**
- _CSS_ **Bootstrap 5**
- _Validation_ **Validator**

## How to install

- `composer install` to install dependencies
- Make `.env` file as a copy of `.env.example` and set environment variables \
    For example
    ```
    APP_MODE=development
    DB_DRIVER=pdo_mysql
    DB_HOST=localhost
    DB_PORT=3306
    DB_USER=root
    DB_PASSWORD=""
    DB_NAME="jack_dev_db"
    ```
- `vendor/bin/phinx migrate` to setup database

## Directory structure

### `app`

The app directory contains the core code of your application. Each app package can contain controllers, models, views and services.

### `bootstrap`

The `bootstrap` directory contains the `bootstrap.php` file which bootstraps the app.

### `cache`

The cache directory contains compiled twig templates.

### `database`

The database directory contains your database migrations.

### `public`

The public directory contains the index.php file, which is the entry point for all requests entering the application and configures auto loading. This directory also houses app assets such as images, JavaScript, and CSS.
