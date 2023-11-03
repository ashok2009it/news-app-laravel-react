

# Backend Take-Home challenge

NewsHub is a cutting-edge news aggregator platform that brings you the latest news from various sources, all consolidated into one easy-to-use interface. With a backend powered by Laravel and a React.js frontend, this offers a seamless experience for users to stay updated with current events and insights from around the world.

## Prerequisites

Before you begin, ensure you have the following installed on your development machine:

- Docker & Docker Compose
- Git (for version control)
- Composer (for managing PHP dependencies)

## Quick Start

To get NewsHub up and running on your local machine, follow these steps:

1. Clone the repository:

   ```bash
   git clone https://github.com/ashok2009it/news-app-laravel-react
   cd news-app-laravel-react

## Docker Compose Services

The `docker-compose.yml` file orchestrates the following services:

- `interview-take-home-challenge`: Runs the PHP-FPM server for the Laravel backend.
- `nginx_webserver`: Serves the React frontend and reverse proxies to PHP-FPM using Nginx.
- `mysql_db`: Hosts the MySQL database for content storage.
- `pma`: PHPMyAdmin Provides a web interface for MySQL database management accessible at `http://localhost:8080`.

## Configuration Overview

Key configuration files include:

- `Dockerfile`: Configures the PHP-FPM container with necessary PHP extensions and Composer.
- `docker-compose.yml`: Outlines all services and configurations for the application stack.
- `nginx.conf`: Settings for the Nginx web server.
- `vite.config.js`: Manages asset builds for Laravel and React.

Once the containers are running, navigate to `http://localhost:8000` in your browser.

## Build Docker Container

```docker-compose up -d --build```

## Database

Access Phpmyadmin: http://localhost:8080/

```
Server: mysql_db
Username: root
Password: root

```

## Configuration in .env file

```
- Database Configuration:

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=homechallenge
DB_USERNAME=root
DB_PASSWORD=root

- Add Your Own NewsAPI keys:

NEWS_API_KEY=7c987dfe38534eacbab28c140a90dsds
THE_GUARDIAN_API_KEY=3ad39471-7a08-471c-99aa-0b3sdsdsdd
NY_TIMES_API_KEY=ZQVVFGV4cV1qUwtVed09b6Xa5sdsdd

```


docker-compose exec interview-take-home-challenge php artisan fetch:articles

This command connects to NewsAPI, The Guardian, and The New York Times, and updates the local articles database.

## Frontend Application

- Built with React.js, initiating from `resources/js/app.tsx`.
- Interfaces with Laravel APIs to fetch and display news articles.

## Backend Application

- Laravel provides the API endpoints for the frontend.
- The `FetchArticles` command in `app/Console/Commands/FetchArticles.php` is tasked with periodically updating articles.
