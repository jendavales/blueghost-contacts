# Contacts

Application created as entry test to https://www.blueghost.cz/kariera/phpdev

## Requirements

- PHP 7.4
- MySQL (mariadb-10.4.19)
- Composer
- Node.js

## Setup

Create database *blueghost* with username *root* and no password.

Or specify database connection in .env

When database is ready, run following commands to complete setup

    composer install
    npm install
    npm run watch
    
    php bin/console make:migration
    php bin/console doctrine:migrations:migrate
    php bin/console doctrine:fixtures:load