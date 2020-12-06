#!/bin/sh

set -e
echo "[ ****************** ] Back - Starting Endpoint of Application"
cd /var/www/html/gerenciar-fiis

if ! [ -d "./vendor" ]; then
    echo "[ ****** ] Generating dependencies of Laravel with Artisan..."
    echo "[ ****** ] Install depedences whit composer..."
    composer install --ignore-platform-reqs --verbose
fi

if ! [ -f ".env" ]; then
    echo "[ ****** ] .env not found."

    echo "[ ****** ] Identified local environment. Copying .env.example"
    cp .env.example .env

    echo "[ ****** ] Key Generate"
    php artisan key:generate

    echo "[ ****** ] DB Migration"
    php artisan migrate

    echo "[ ****** ] DB Seed"
    php artisan db:seed
fi

if ! [ -d "./storage/" ]; then
    echo "[ ****** ] Creating storage folder"
    mkdir ./storage/
    mkdir ./storage/framework
fi

if ! [ -d "./storage/framework" ]; then
    echo "[ ****** ] Creating storage/framework folder"
    mkdir ./storage/framework
fi

if ! [ -d "./storage/framework/cache" ]; then
    echo "[ ****** ] Creating cache folder"
    mkdir ./storage/framework/cache
fi

if ! [ -d "./storage/framework/sessions" ]; then
    echo "[ ****** ] Creating sessions folder"
    mkdir ./storage/framework/sessions
fi

if ! [ -d "./storage/framework/views" ]; then
    echo "[ ****** ] Creating views folder"
    mkdir ./storage/framework/views
fi

echo "[ ****** ] Giving write permission to storage folder"
chmod -R 777 ./storage/*

echo "[ ****************** ] Back - Ending Endpoint of Application"
exec "$@"
