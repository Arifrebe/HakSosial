# Simple PHP Project Setup

## Table of Contents

- [About](#about)
- [Getting Started](#getting_started)
    - [Prerequisites](#prerequisites)
    - [Installing](#installing)
- [Usage](#usage)
- [Database Connection (PDO)](#database-connection-pdo)
    - [configure your config.php](#1-configure-your-configphp)
    - [Fetch data with PDO](#2-fetch-data-with-pdo)
    - [Insert Data with PDO](#3-insert-data-with-pdo)
- [Beautiful Links](#beautiful-links)
- [Conclusion](#conclusion)

## About <a name = "about"></a>

This project provides a minimal PHP starter for inline scripting, allowing developers to quickly write and execute PHP code within HTML. It supports PDO (PHP Data Objects) for secure database interactions.

With this inline PHP starter, developers can easily mix PHP logic with HTML without the need for complex setups or frameworks. It’s ideal for beginners learning PHP basics, quick prototyping, or handling simple dynamic content in a web page.

## Getting Started <a name = "getting_started"></a>

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites <a name = "prerequisites"></a>

Before you begin, make sure you have the following installed on your system:
- PHP (Version 7.4 or later recommended)
- A Web Server (Optional: Apache, Nginx, or use PHP’s built-in server)
- A Code Editor (Recommended: VS Code, Sublime Text, or PHPStorm)
- A Web Browser (e.g., Chrome, Firefox) to test your application
- A Database (Optional) – MySQL, MariaDB, or SQLite if you plan to use a database

### Installing <a name = "installing"></a>

1. Clone the Repository (if using Git):
```
git clone https://github.com/Arifrebe/simple-php-project-setup.git
```
Then, navigate to the project directory:
```
cd simple-php-project-setup
```

2. Run the Project Using PHP’s Built-in Server
```
php -S localhost:8000
```
Now, open your browser and visit:
```
http://localhost:8000
```

## Usage <a name = "usage"></a>

To use this PHP starter project, simply open the `home.view.php` in the views folder and start adding your PHP logic inside the `<body>` section.  

Example of embedding PHP in HTML:
```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Starter</title>
</head>
<body>
    <h1>Welcome to My Simple PHP Project</h1>
    <p>Current Date and Time: <?php echo date("Y-m-d H:i:s"); ?></p>
</body>
</html>
```

## Database Connection (PDO)  <a name="database-connection-pdo"></a>
This project supports PDO (PHP Data Objects) for secure and efficient database connections.

### 1. configure your `config.php` <a name="configure-your-configphp"></a>

Ensure you have your config.php file with the following content:
```
<?php
// Define your database credentials
define('DBNAME', 'pictoria');
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBDRIVER', 'mysql');
?>
```

### 2. Fetch data with PDO <a name="fetch-data-with-pdo"></a>
```
<?php
require 'database.php';
$sql = "SELECT * FROM users";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll();
foreach ($users as $user) {
    echo "User: " . $user['name'] . "<br>";
}
?>
```

### 3. Insert Data with PDO <a name="insert-data-with-pdo"></a>
```
<?php
require 'database.php';
$sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'name' => 'John Doe',
    'email' => 'john@example.com'
]);
echo "User added successfully!";
?>
```

## Beautiful Links <a name="beautiful-links"></a>

To improve user experience, this project use support for beautiful links (clean URLs) using `.htaccess` in Apache. This removes the need to include `.php` file extensions in URLs.

### Usage Example
Instead of accessing:
```
http://localhost:8000/home.php
```
You can now access:
```
http://localhost:8000/home
```
This makes URLs cleaner and more user-friendly.

## Conclusion <a name = "conclusion"></a>
With this setup, you can now securely and efficiently interact with your MySQL database using PDO, and you also get the benefit of beautiful URLs using `.htaccess`. Modify the `config.php` file for different environments (e.g., development, production), and feel free to extend the functionality to support CRUD operations.

