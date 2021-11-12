## Build Setup
```bash
# clone repository 
$ git clone https://github.com/zhimchik1/soft.git

# composer install 
$ composer install

# copy .env.example file 
$ cp .env.example .env

# app key generete 
$ php artisan key:generate

# connect to databases  
$ DB_CONNECTION=mysql
$ DB_HOST=127.0.0.1
$ DB_PORT=3306
$ DB_DATABASE=main
$ DB_USERNAME=username
$ DB_PASSWORD=password
  
$ DB_CONNECTION2=mysql
$ DB_HOST2=127.0.0.1
$ DB_PORT2=3306
$ DB_DATABASE2=main_tmp
$ DB_USERNAME2=username
$ DB_PASSWORD2=password

# run migrations
$ php artisan migrate

# run server on localhost:8000
$ php artisan serve
```
