# Laravel Project

A Laravel-based web application providing a modern, clean, and efficient development environment for web solutions.

## 📖 Features

- User Authentication & Registration
- Unit and Feature Testing with PHPUnit
- Database Migrations and Seeders
- Laravel Blade Templating
- Artisan CLI tools for rapid development

## 🛠️ Tech Stack

- **PHP** 8.2+
- **Laravel** 11
- **Composer**
- **MySQL**
- **PHPUnit**
- **Tailwind ( css framework)**
- **Docker (optional)**

### Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL 8.0 or higher
- Node.js and NPM (if using frontend assets)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/umarm6/hams.git
   cd hams

2. **Install PHP dependencies**
     ```bash
    composer install

3. **Copy .env file**
     ```bash
    cp .env.example .env

4. **Generate the application key** php artisan key:generate
    ```bash
   php artisan key:generate

5. **Configure your database credentials in .env**
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=hms
    DB_USERNAME=dev
    DB_PASSWORD=123
   
6. **Run database migrations**
    ```bash
    php artisan migrate --seed
   
7. **Install frontend dependencies and run dev serve**
    ```bash
    npm install
    npm run dev

### **Serve the application**
    php artisan serve


### Running Tests

To execute the test suite:

    php artisan test

or
```bash 
./vendor/bin/phpunit
```  

### 📂 Directory Structure
- app/ - Application core files (controls,models,etc)
- routes/ - Web and API route definitions 
- database/ - Migrations, factories, and seeders 
- tests/ - Unit and Feature tests 
- resources/ - Blade templates and frontend assets











