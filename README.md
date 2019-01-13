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
http://127.0.0.30/
```
Login page:
```text
http://127.0.0.30/login

phpmyadmin:
```text
http://127.0.0.39/
```
Default data for login:
```text
Username: user
Password: 000

```
phpMyAdmin data:
```text
server: blog
username: root
password: 123



```
