# Setup

### Step by Step
Clone Repository  

```sh
git clone https://github.com/xSaraKemily/doc-store.git
```

```sh
cd doc-store
```

Start the project containers

```sh
docker-compose up -d
```

Create the .env file

```sh
cp .env.example .env
```

Access the app container

```sh
docker-compose exec app bash
```

Install project dependencies

```sh
composer install
```

Generate the Laravel application key

```sh
php artisan key:generate
```

Run the migrations

```sh
php artisan migrate
```

Access the project: http://localhost:8000
