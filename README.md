# FCity

## Install the laravel website

* Clone your project
* Go to the folder application using `cd` command on your cmd or terminal
* Run `composer install` on your cmd or terminal
* Copy `.env.example` file to `.env` on the root folder. You can type `copy .env.example .env` if using command prompt Windows or `cp .env.example .env` if using terminal, Ubuntu
* Open your `.env` file and change the database name (`DB_DATABASE`) to whatever you have, username (`DB_USERNAME`) and password (`DB_PASSWORD`) field correspond to your configuration.
* By default, the username is  `root` and you can leave the password field empty. (This is for Xampp)
* By default, the username is `root` and password is also root. (This is for Lamp)
* Run `php artisan key:generate`
* Run `php artisan migrate`
* Run `php artisan serve`
* Go to localhost:8000

## Install grafana

* Run `wget https://dl.grafana.com/oss/release/grafana_5.4.2_amd64.deb`
* And `sudo dpkg -i grafana_5.4.2_amd64.deb`

## Install php extension for laravel

* Run `sudo apt-get install php-common php-mbstring php-xml php-zip`

## Enable mysql driver

* You might need to comment out the following in your php.ini file : `;extension=pdo_mysql.so`

https://stackoverflow.com/questions/38602321/cloning-laravel-project-from-github
https://stackoverflow.com/questions/40815984/how-to-install-all-required-php-extenions-for-laravel
https://stackoverflow.com/questions/42557693/laravel-pdoexception-could-not-find-driver