# Laravel To-Do API

Это простое приложение для управления задачами, созданное на Laravel. Предоставляет RESTful API для работы с задачами.

## 🚀 Начало работы

Следуйте этим шагам, чтобы запустить проект локально:

```bash
# 1. Клонируйте репозиторий
git clone https://github.com/ваш-юзернейм/ваш-репозиторий.git
cd ваш-репозиторий

# 2. Установите зависимости
composer install

# 3. Создайте файл окружения и сгенерируйте ключ приложения
cp .env.example .env
php artisan key:generate

# 4. Укажите настройки базы данных в файле .env
# Пример:
# DB_DATABASE=todo_db
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Выполните миграции базы данных
php artisan migrate

# 6. Запустите сервер
php artisan serve
