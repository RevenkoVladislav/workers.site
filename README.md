### Workers - a Laravel project for managing temporary work assignments

Workers is a learning project built on Laravel where companies can post temporary work shifts, and workers can apply,
await confirmation, and see their scheduled work in their dashboard.

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![Vite](https://img.shields.io/badge/vite-%23646CFF.svg?style=for-the-badge&logo=vite&logoColor=white)
![Bootstrap](https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)
![Postman](https://img.shields.io/badge/Postman-FF6C37?style=for-the-badge&logo=postman&logoColor=white)

### Install and settings

```
git clone https://github.com/RevenkoVladislav/workers.site.git
cd workers.site
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run dev
php artisan serve
```

### Current features

- Display all workers as cards on the homepage.
- Component-based frontend using Blade and Bootstrap (components for input, textarea, checkbox, etc.)
- CRUD for workers.
- FullText search.
- Artisan console command to generate test data. `--workers=N` generate N workers, `--reset` truncate DB.

```
php artisan generate:data --workers=N --reset
```

### Technologies used

- laravel 12
- Blade + Bootstrap.
- Mysql
- Postman
- Vite

### Screenshots

