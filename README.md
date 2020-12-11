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

Теперь должна быть возможность получить доступ к приложению по адресу:

~~~
http://localhost:8000
~~~

Api будет доступно по адресу:

~~~
http://localhost:8000/api/v1
~~~


Токены для тестирования
----
~~~
Админ - eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1aWQiOjEsImlzX2FkbWluIjoxfQ.ezySHuOEVex_PhBNbAGVfFz7OAOOVvKHZ7LyEHA9RY8
Юзер - eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1aWQiOjEsImlzX2FkbWluIjowfQ.0vBHhpYuDYK5ZNfrmTFWqO0xdJPOZuLcM7xcf6Z4D4M
~~~

**NOTES:**
- Минимальная версия Docker `17.04`