## Contributing
When contributing to this repository, please first discuss the change you wish to make via issue, email, or any other method with the owner of this repository before making a change.

Please note we have a code of conduct, please follow it in all your interactions with the project.

## Pull Request Process
- Ensure that your changes comply with the project's coding guidelines and that it's sufficiently documented.
- Update the README.md with details of changes to the interface, this includes new environment variables, exposed ports, useful file locations and container parameters.
- Target the develop branch for your Pull Requests as this is were new changes are introduced.
- After being successfully reviewed pull requests will be merged to develop branch and will finally be included in an upcoming release.

## Steps Laravel Project:
- Install Video Tutorial

https://www.youtube.com/watch?v=U1zIbFJqXHU

- Clone Project

```bash
$ git clone https://github.com/foroworkers/foroworkers.git
``` 

- Pull Project Dev Branch

```bash
$ git pull origin dev
``` 
- Navigate to the root of the Laravel project

```bash
$ cd foroworkers
``` 
- Setup vendor libraries 

```bash
$ composer install
```

- Setup .env file, myconfig.php and create database
- Avoid changing the author data as this may cause problems when running the project.

- Copy .env.example config and generate Key project 

```bash
$ cp .env.example .env
``` 
```bash
$ php artisan key:generate
``` 

```bash
$ First Step Create New Database in myconfig.php file Example: foroworkers
  define('CDB_DATABASE_HOST', '');
  define('CDB_DATABASE_USERNAME', '');
  define('CDB_DATABASE_PASSWORD', '');
  define('CDB_DATABASE', '');
``` 

```bash
Second Step Create New Database in .env file Example: foroworkers

APP_LOCALE=en
PAYPAL_EMAIL=yourpaypalemail
APP_ENDPOINT=https://sistemaspymesjc.blogspot.com/p/trabaja-con-nosotros.html
APP_ENDPOINT_LOCAL=
APP_AUTHOR=jonathancastro
APP_EMAIL=sistemaspymesjc@gmail.com
APP_COPYRIGHT=sistemaspymesjc
APP_DONATE=https://www.paypal.com/paypalme/programadorjonathan
APP_PHONE=5804241666224

database connection

DB_DATABASE=foroworkers
DB_USERNAME=your_username
DB_PASSWORD=your_password

for sending emails

MAIL_MAILER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
```

```bash
$ php artisan migrate:fresh --seed
```
```bash
$ php artisan storage:link
```
```bash
$ php artisan optimize:clear
```
- Run server

```bash
$ php artisan serve
```



## Access Web-App:

- https://youtu.be/r8JGzp6Sw28

_Admin: admin@gmail.com
_Pass: Test1234

_User: user@gmail.com
_Pass: Test1234
