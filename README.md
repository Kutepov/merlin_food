СТРУКТУРА ДИРРЕКТОРИЙ
-------------------

      config/             конфигурации приложения
      controllers/        классы контроллеров
      models/             классы моделей
      migrations/         миграции
      modules/            Api
      runtime/            файлы, сзданные в рантайме
      vendor/             пакеты зависимостей
      web/                точка входа в приложение

СБОРКА
------------

Разверните проект, используя следующую команду:

~~~
$ docker-compose up --build
~~~

Развернется development окружение.

Чтобы развернуть production окружение, нужно собрать образ, используя аргумент ENVIRONMENT:
~~~
$ docker-compose build --build-arg ENVIRONMENT=prod
$ docker-compose up -d
~~~

Теперь должна быть возможность получить доступ к приложению по адресу:

~~~
http://localhost:8000
~~~

Api будет доступно по адресу:

~~~
http://localhost:8000/v1
~~~

Документация по api доступна по адресу:

~~~
http://localhost:8000/documentation
~~~

**NOTES:**
- Минимальная версия Docker `17.04`