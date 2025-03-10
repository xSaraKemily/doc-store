# 🚀 Setup

📌 <mark>This setup assumes you have Docker installed<mark>

Clone Repository  

```sh
git clone https://github.com/xSaraKemily/doc-store.git
```

```sh
cd doc-store
```

Start the project containers
---
```sh
docker-compose up -d
```

Create the .env file
---
```sh
cp .env.example .env
```

Access the app container
---
```sh
docker-compose exec app bash
```

Install project dependencies
---
```sh
composer install
```

Generate the Laravel application key
---
```sh
php artisan key:generate
```

Run the migrations
---
```sh
php artisan migrate
```

# Database Connection

Host: localhost <br>
Port: 3300 <br>
User: username <br>
password: userpass <br>
database: laravel

# How to access uploaded files on local storage

```sh
sudo docker exec -it doc-store-app-1 bash
```

```sh
cd storage/app/private/uploads
```

```sh
ls
```

## Access to Project: http://localhost:8000
## Access to RabbitMQ: http://localhost:15672 (login: user / password: password)
# The project's timezone is America/New_York
