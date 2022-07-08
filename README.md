# Nizek Sample Test

## About Project

Nizek test project is a simple project that is written by PHP/Laravel Framework as an assessment challenge. 
<hr/>

## How To:

### Install & Run

- `composer install`
- `php artisan migrate`
- `php artisan serve`

### Run using Docker

- `docker-compose up -d --build`
- `chown 33:33 -R docker-data/storage`
- `docker-compose exec app php artisan migrate`