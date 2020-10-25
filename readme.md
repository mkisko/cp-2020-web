# GC.Platform

### Стек

  - `php7.4-fpm`
  - `nginx`
  - `docker`
  - `docker-compose`
  - `MySQL`

### Зависимости
- `ssh`
- `git`
- `nano`
- `zlib1g-dev`
- `libxml2-dev`
- `libzip-dev`
- `libxslt-dev`
- `libyaml-dev`
- `unzip`
- `tig`
- `zip`
- `intl`
- `mysqli`
- `pdo_mysql`
- `curl`
- `composer`

### Команда

- *Паша* - занимался фронтом и DevOps. Крутая инфраструктура за 3 минуты одной команды
- *Юля* - лучший дизайнер по версии прошлого финала Хакатона. Идеальные отступы, правильные гайды. 
- *Свят* - лучшие custdev-интервью. Анализ требований.Что то не знаешь? Спроси у Славы, добудет любую информацию.
- *Айдин* - iOS по феншую, долой xib и storyboard. Viper-архитектура в условиях хакатона.
- *Кирилл* - занимался бекэнд частью. Через API-метод может рассказать все что угодно.

### Требования перед установкой

Для установки Docker Engine вам потребуется 64-разрядная версия одной из этих версий Debian или Raspbian:
- `Debian Buster 10 (stable)`
- `Debian Stretch 9 / Raspbian Stretch`

`Docker Engine` поддерживается архитектурами x86_64 (или amd64), armhf и arm64.

1. Установите `docker` согласно инструкции - [docker](https://docs.docker.com/engine/install/)
2. Установите `docker-compose` - [docker-compose](https://docs.docker.com/compose/install/)
3. Установите зависимости и запустите `docker-compose`:
```sh
$ git clone https://github.com/mkisko/cp-2020-web.git
$ docker-compose up
```
4. Далее войдите в контейнер `docker-compose`:
```sh
docker-compose exec -it <ID CONTAINER>
```
5. Выполните следующие команды:
```sh
$ composer install
$ bin/console doctrine:schema:create  //Выполняется только при первоначальном  развертывании
$ bin/console doctrine:schema:update --force
$ bin/console cache:clear
```
