# Timezone API

A Laravel-based service that keeps user attributes (name, last name, timezone) synced with a third-party provider whenever they change, respecting the provider's rate limits.

## Overview

The provider API allows up to 50 requests/hour for batch endpoints (up to 1,000 records each, so 50,000 updates/hour) and 3,600 individual requests/hour for other endpoints. This project only calls the API for users whose attributes actually changed — roughly 40,000 calls/hour at peak — via a scheduled job.

## Tech Stack

- PHP 8.1+, Laravel
- MySQL
- Laravel queues & scheduler

## Prerequisites

- PHP 8.1+
- Composer
- MySQL

## Installation

```sh
git clone https://github.com/andreattamatheus/timezoneApi
cd timezoneApi
composer install
```

Copy `.env.example` to `.env` and fill in your database credentials:

```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=YOUR_DATABASE
DB_USERNAME=YOUR_USERNAME
DB_PASSWORD=YOUR_PASSWORD
```

```sh
php artisan optimize
php artisan migrate:fresh --seed
php artisan serve
```

## Background Jobs

```sh
php artisan queue:listen         # process queued jobs
php artisan schedule:list        # list scheduled jobs
php artisan app:process-users    # run the user-sync command manually
php artisan schedule:run         # run the schedule routine
```

## Quality

```sh
./vendor/bin/pint
```

## Contact

Matheus Andreatta — [@andreattamatheus](https://github.com/andreattamatheus)
