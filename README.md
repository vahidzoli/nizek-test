# Nizek Sample Test

## About Project

Nizek test project is a simple project that is written by PHP/Laravel Framework as an assessment challenge. 
<hr/>

## How To:

### Install & Run

- `git clone https://github.com/vahidzoli/nizek-test.git`
- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- `create a database and change .env config`
- `php artisan migrate`
- `php artisan serve`
- `use systemd to create a worker /etc/systemd/system/`
- `touch nizek-queue.service`

```
[Unit]                          
Description=Laravel queue worker   

[Service]
User=www-data                   
Group=www-data
Restart=always
ExecStart=/usr/bin/php /path-to/artisan queue:work --timeout=0
[Install]     
WantedBy=multi-user.target

```

### Run using Docker

- `docker-compose up -d --build`
- `chown 33:33 -R docker-data/storage`
- `docker-compose exec app php artisan migrate`