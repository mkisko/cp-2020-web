# GC Platform Web


## Описание
Платформа и мобильное приложение обеспечивают максимально продуктивное взаимодействие между соискателем (студентом или выпускником университета) и работодателем (представителем компании) для дальнейшего трудоустройства. Учащийся в самом начале своего карьерного пути получает поэтапный план личностного развития. С каждый пройденным шагом студент приобретает новые навыки и компетенции. Система рекомендует на основе подтвержденных вузом достижений подходящие вакансии по профилю студента. Работодатель в свою очередь, получает доступ к учебным данным студента для выбора кандидата, отвечающего требованиям.

## Уникальность проекта
Наше решение помогает студенту построить детальный путь своего развития в рамках выбранной специальности для дальнейшего трудоустройства.

## Технологии
PHP (Symfony Framefork, Webpack), RestAPI (json, xml), iOS (swift, Alomofire, Viper), Figma + Figmamotion.

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
$ docker-compose build
$ docker-compose up -d
```
4. Далее войдите в контейнер `docker-compose`:
```sh
docker-compose exec -it <ID CONTAINER>
```
5) Далее войти в контейнер `php` (`docker-compose exec php bash`) и выполнить:  
```sh 
$ composer install
$ bin/console doctrine:schema:create
$ bin/console doctrine:schema:update --force
$ bin/console cache:clear`
```

6) Все хорошо. Теперь сервер запущен и доступен по адресу `http://localhost:8000/.
