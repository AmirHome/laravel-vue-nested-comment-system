# Nested Comments system
This is simple nested comment app made with Laravel 8.6, Vue 2.6, PHP 8 and MySQL 8 powered by Docker.

Developer **Amir Hosseinzadeh** Published **Nov 25, 2021**

## How to Install
    bash ./docker/run.sh 

#### Useful Commands
###### Start Docker
    bash ./vendor/bin/sail up -d
###### Stop Docker
    bash ./vendor/bin/sail down
###### Check PHP Version of Docker
    bash ./vendor/bin/sail php -v
###### Check Node Version of Docker
    bash ./vendor/bin/sail node --version
###### ReMigrate in Docker
    bash ./vendor/bin/sail artisan migrate:refresh --seed
