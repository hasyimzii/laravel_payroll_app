# Laravel Payroll App
Website for managing employee payrolls

## Diagrams
- ERD and SQL backup file [./database](https://github.com/hasyimzii/laravel_payroll_app/tree/main/database).
- Flowchart Diagram [./flowchart](https://github.com/hasyimzii/laravel_payroll_app/tree/main/flowchart).

## How to install
1. Clone this repository
```sh
git clone https://github.com/hasyimzii/laravel_payroll_app.git
```

2. Open directory and update composer
```sh
composer update
```

3. Copy .env.example file
```sh
cp .env.example .env
```

4. Create MySQL database (e.q. laravel_payroll_app)

5. Open .env file and change the database credentials
```sh
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=laravel_payroll_app
DB_USERNAME=<your db username>
DB_PASSWORD=<your db password>
```

6. Generate app key
```sh
php artisan key:generate
```

7. Migrate database and run seeder
```sh
php artisan migrate --seed
```

8. Run server
```sh
php artisan serve
```

## User credentials
- Supervisor user
```sh
username: spvpayroll
password: password123
```

- Staff user
```sh
username: stfpayroll
password: password123
```