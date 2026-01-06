<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# About project

```bash
null
```
---
# download project
https://download-directory.github.io/?url=https://github.com/Truesigen/Test_tasks/tree/main/blue

---
#  install and settings
```bash
# install php dependencies
composer install

# copy env-file
cp .env.example .env

# generate laravel key
php artisan key:generate

# setup db settings in .env

APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=?
DB_USERNAME=?
DB_PASSWORD=?

QUEUE_CONNECTION=redis
CACHE_DRIVER=redis

# migrate and seed db
php artisan migrate --seed
```
---
# Authorization

request:
```bash
curl -X POST http://localhost/api/register \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@test.com","password":"password"}'
```

response:
```json
{
  "token": "YOUR_API_TOKEN"
}
```

use token:

```http
Authorization: Bearer YOUR_API_TOKEN
```

---


->>>>>>>>>
