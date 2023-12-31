# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/8.0/installation#installation)

Switch to the repo folder

    cd crud_laravel

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate --seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    cd crud-laravel
    composer install
    cp .env.example .env
    php artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate --seed
    php artisan serve
## Endpoint

- `api/customer` - List All Customers
- `api/customer/create` - Page Create New Customer
- `api/customer/{cst_id}` - Show Customer By cst_id (GET)
- `api/customer/{cst_id}` - Update Customer (PATCH)
- `api/customer/{cst_id}` - Delete Existing Customer By cst_id (DELETE)
- `api/customer/store` - Store/Save Customer