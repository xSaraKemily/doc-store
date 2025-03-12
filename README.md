# 📂 File Storage App  

## 📝 Purpose  
This project is a web application built with **Laravel** for temporarily storing **PDF** and **DOCX** files. The system allows file uploads with a size limit, manages stored files, and automatically deletes them after **24 hours**, sending a message to **RabbitMQ** upon deletion.  

## 🔹 Main Features  
- **Asynchronous file upload** for PDF and DOCX (maximum 10MB).  
- **Management page** to download and manually delete files.  
- **Automatic deletion** of files after 24 hours.  
- **Message sent to RabbitMQ** when a file is deleted (automatically or manually).  

## 🛠️ Technologies Used  
- **Backend:** Laravel  
- **Database:** MySQL  
- **Messaging:** RabbitMQ  
- **Frontend:** Bootstrap + jQuery  
- **Infrastructure:** Docker/Docker Compose  

![image](https://github.com/user-attachments/assets/0a20323d-dbad-47bb-988b-6e7b2129a908)

![image](https://github.com/user-attachments/assets/c80ea51a-411c-4f07-9e3e-9cf92d5c8633)

![image](https://github.com/user-attachments/assets/8ec119f1-d9ea-4814-a32b-729fcb7093b5)



# 🚀 Setup
---

📌 <b>Tech Stack:</b> Laravel 11, PHP 8.3, MySQL 8.0, RabbitMQ, Docker, Docker Compose, Bootstrap, Jquery, JavaScript

📌 This setup assumes you have Docker/Docker Compose installed

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

## <mark>Important:</mark>  The project's timezone is America/New_York
## Access to Project: http://localhost:8000
## Access to RabbitMQ: http://localhost:15672 (login: user / password: password)
