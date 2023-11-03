

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

Once the containers are running, navigate to `http://localhost:8000` in your browser.

## Docker Compose Services

The `docker-compose.yml` file orchestrates the following services:

- `app`: Runs the PHP-FPM server for the Laravel backend.
- `webserver`: Serves the React frontend and reverse proxies to PHP-FPM using Nginx.
- `db`: Hosts the MySQL database for content storage.
- `phpmyadmin`: Provides a web interface for MySQL database management accessible at `http://localhost:8080`.

## Configuration Overview

Key configuration files include:

- `Dockerfile`: Configures the PHP-FPM container with necessary PHP extensions and Composer.
- `docker-compose.yml`: Outlines all services and configurations for the application stack.
- `nginx.conf`: Settings for the Nginx web server.
- `vite.config.js`: Manages asset builds for Laravel and React.

## Laravel Command: Fetch Articles

The custom Laravel artisan command `fetch:articles` retrieves articles from various news sources:

```sh
docker-compose exec app php artisan fetch:articles

This command connects to NewsAPI, The Guardian, and The New York Times, and updates the local articles database.

## Frontend Application

- Built with React.js, initiating from `resources/js/app.tsx`.
- Interfaces with Laravel APIs to fetch and display news articles.

## Backend Application

- Laravel provides the API endpoints for the frontend.
- The `FetchArticles` command in `app/Console/Commands/FetchArticles.php` is tasked with periodically updating articles.
