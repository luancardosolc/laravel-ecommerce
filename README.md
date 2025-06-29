## Instructions to run this project

Inside the folder /docker run the command:
    
    docker compose up -d

Install the composer dependencies:

    docker exec -it app bash
    composer install

Create the .env file:
    
    cp .env.example .env

Execute the migrations:
    
    php artisan migrate

## Creating a test user

To create a test user for API testing, you can use Laravel Tinker:

    php artisan tinker

Then create a user:

```php
$user = \App\Models\User::create([
    'name' => 'Test User',
    'email' => 'test@example.com',
    'password' => bcrypt('password123')
]);
```

Exit tinker with `exit` or `Ctrl+C`.

## Getting authentication token

To get a bearer token for API authentication, you can either:

### Option 1: Use the registration endpoint
Make a POST request to `/api/register` with:
```json
{
    "name": "Test User",
    "email": "test@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

### Option 2: Use the login endpoint
Make a POST request to `/api/login` with:
```json
{
    "email": "test@example.com",
    "password": "password123"
}
```

Both endpoints will return a response containing a `token` field. Use this token as a Bearer token in the Authorization header for protected API endpoints:
```
Authorization: Bearer your_token_here
```

Import the file inside /postman folder to your postman app, so you can have all API Endpoints.

## Applications ports

- The webserver will run on port 80
- The php-fpm will run on port 9000
- The database will run on port 3306

## Running the tests

To run the tests built to this project, go to the docker container:

    docker exec -it app bash

Run the tests:

    php artisan test

## Swagger / OpenAPI

Accessing swagger:

    http://localhost/api/documentation

Regenerating Docs:
    
    php artisan
