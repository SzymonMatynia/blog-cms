# Blog CMS

## Build application
Go to repository directory:
```bash
$ cd blog-cms
```
Build image via docker:
```bash
$ sudo docker-compose up -d --build
```
Download vendor via composer:
```bash
$ sudo docker-compose run www composer install
```
Migrate, create, database and create admin user:
```bash
$ sudo docker-compose run www doctrine:database:create
$ sudo docker-compose run www make:migration
$ sudo docker-compose run www doctrine:migrations:migrate
$ sudo docker-compose run www doctrine:fixtures:load
```
Main page:
```text
http://127.0.0.31/
```
Login page:
```text
http://127.0.0.31/login
phpmyadmin:
```text
http://127.0.0.34/
```
Default data for login:
```text
Username: user
Password: 123
```
