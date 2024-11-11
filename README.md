# Test Project

## Overview

This project is a Laravel-based that update users with some information (name, lastname or timezone) is changed.
It's a hourly schedule, that has some API limitaton:

We use a third-party API that has the following limits: You can make up to 50 requests per hour for batch endpoints and 3,600 individual requests per hour for other API endpoints. Each batch request accommodates up to 1,000 records in the payload for a total of 50,000 updates per hour.

We want to keep the user attributes up to date with the provider. We only need to make calls for the user whose attributes are changing. This is about 40000 calls per hour.

## Table of Contents

-   [Requirements](#requirements)
-   [Installation](#installation)
-   [Configuration](#configuration)
-   [Running the Application](#running-the-application)
-   [API Endpoints](#api-endpoints)
-   [Authentication](#authentication)

## Requirements

-   PHP 8.1 or higher
-   Composer
-   MySQL

## Installation

**Clone the Repository**

```bash
git clone https://github.com/andreattamatheus/timezoneApi
cd your-project
```

## Project API

Copy the .env-example and rename it to .env

Inside the .env file, you must filled the correct info about your DB.

-   DB_HOST=127.0.0.1
-   DB_PORT=3306
-   DB_DATABASE=YOUR_DATABASE
-   DB_USERNAME=YOUR_USERNAME
-   DB_PASSWORD=YOUR_PASSWORD

```
composer install
```

```
php artisan optimize
```

```
php artisan migrate:fresh --seed
```

```
php artisan serve
```

### Pint

```
 ./vendor/bin/pint
```

### Run job

Then run:

```
php artisan queue:listen
```

You can check the schedules tasks:

```
php artisan schedule:list
```

If you want to run the command to parse the content, you can try:

```
php artisan app:process-users
```

To runt he schedule routine

```
php artisan schedule:run
```
