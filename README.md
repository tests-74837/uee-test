## UEE Test Project

This is a test project for the Ukrainian Energy Exchange. Stack:

- Apache Web Server
- PHP 8.4
- PostgreSQL 18
- Laravel 12

To run project clone this repository and run the following command in the project directory:

```
docker compose up
```

This will start the application and its dependencies in Docker containers. The application will be accessible at `http://localhost`. The documentation for the application is available at `http://localhost/api/documentation`. To run tests, enter the application container:

```
docker compose exec app bash
```

Then run the tests with the following command:

```
php artisan test
```