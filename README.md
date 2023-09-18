# Laravel Payroll App
Website for managing employee payrolls

## Diagrams
- ERD and SQL backup file [./database](https://github.com/hasyimzii/laravel_payroll_app/tree/main/database).
- Flowchart Diagram [./flowchart](https://github.com/hasyimzii/laravel_payroll_app/tree/main/flowchart).

## How to install
1. Clone this repository
```shell
git clone https://github.com/hasyimzii/laravel_payroll_app.git
```

2. Open directory and update composer
```shell
composer update
```

3. Copy .env.example file
```shell
cp .env.example .env
```

4. Create MySQL database (e.q. laravel_payroll_app)

5. Open .env file and change the database credentials
```shell
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=laravel_payroll_app
DB_USERNAME=<your db username>
DB_PASSWORD=<your db password>
```

6. Generate app key
```shell
php artisan key:generate
```

7. Migrate database and run seeder
```shell
php artisan migrate --seed
```

8. Run server
```shell
php artisan serve
```

## User credentials
- Supervisor user
```shell
username: spvpayroll
password: password123
```

- Staff user
```shell
username: stfpayroll
password: password123
```