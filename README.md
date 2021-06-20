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

## Swagger

    //TODO
