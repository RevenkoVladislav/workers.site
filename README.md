### Workers - a Laravel project for managing temporary work assignments

Workers is a learning project built on Laravel where companies can post temporary work shifts, and workers can apply,
await confirmation, and see their scheduled work in their dashboard.

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![Vite](https://img.shields.io/badge/vite-%23646CFF.svg?style=for-the-badge&logo=vite&logoColor=white)
![Bootstrap](https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)
![Postman](https://img.shields.io/badge/Postman-FF6C37?style=for-the-badge&logo=postman&logoColor=white)

---
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
php artisan queue:work
```
---
### Current features

- Display all workers as cards on the homepage.
- Component-based frontend using Blade and Bootstrap (components for input, textarea, checkbox, etc.)
- Managers can CRUD for workers with validations and display errors.
- FullText search.
- Artisan console command to generate test data. `--workers=N` generate N workers, `--managers=N` generate N managers, `--reset` truncate DB.

```
php artisan generate:data --workers=10 --managers=10
```

- Event and Listener: Sending a verified email. If a Manager has registered a Worker, send a generated password.
- Queue for sending emails.
---
### Technologies used

- laravel 12
- Blade + Bootstrap.
- Mysql
- Postman
- Vite
---
### Screenshots
<div><p>Homepage displaynig workers:</p>
<img width="1589" height="987" alt="main page" src="https://github.com/user-attachments/assets/e7c9e541-1041-426d-bda0-a34486fa6ec9" />
</div>

---
<div><p>Create page with validations and display errors:</p>
<img width="1306" height="823" alt="Create" src="https://github.com/user-attachments/assets/1fbcb303-c798-4fbf-8936-7a356f877472" />
</div>

---
<div><p>FullText search:</p>
<img width="1319" height="614" alt="Fulltext search" src="https://github.com/user-attachments/assets/21ce6389-af3c-4768-b2e6-d739260c2674" />
</div>

---
<div><p>Artisan command `generate:data`:</p>
<img width="1101" height="364" alt="artisan command" src="https://github.com/user-attachments/assets/ab1d4b76-2dcf-4f2e-a68c-578e26403569" />
</div>

---
<div><p>Queue:work:</p>
<img width="1623" height="266" alt="queue" src="https://github.com/user-attachments/assets/c8a420ce-a2f0-4433-adab-e94f3da975ed" />
</div>

---
<div><p>Sending emails:</p>
<img width="1179" height="76" alt="emails" src="https://github.com/user-attachments/assets/f7313faa-478d-4de9-a881-c737d869572e" />
</div>



