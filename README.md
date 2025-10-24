# 📚 Book Rating & Recommendation System

A simple Laravel 10 web application built for **John Doe’s Bookstore**, designed to manage book collections, collect user ratings, and display insights such as the most popular books and authors.

---

## 🚀 Features

- 📖 **List of Books** — View and filter books collection by title, category, or rating  
- 🧑‍🎓 **Top 10 Most Famous Authors** — Automatically calculated based on average book ratings  
- ⭐ **Book Rating Input** — Customers can rate books on a scale of 1–10  
- 📊 **Sorting & Pagination** — Sort books by rating, voters count, or author popularity  

---

## ⚙️ Tech Stack

- **Framework:** Laravel 10  
- **Language:** PHP 8.1  
- **Database:** MySQL  
- **Frontend:** Blade Templates + Bootstrap 5  
- **Environment:** Localhost or Laravel Sail  

---

## 🧩 Installation Guide

### Clone the repository
https://github.com/sukmagv/timedoor-app.git

### Install Dependencies
composer install

### Create .env file
cp .env.example .env

### .ENV Configuration, set database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=timedoor_app
DB_USERNAME=root
DB_PASSWORD=

### GENERATE APP KEY
php artisan key:generate

### Run migrations and seed sample data
php artisan migrate --seed

### Start Local Servel
php artisan serve

### Now open http://localhost:8000 in your browser
