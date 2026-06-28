<?php

// Include the configuration file that should define the database constants
require 'config.php';

// Check if all required database constants are defined
if (defined('DBDRIVER') && defined('DBHOST') && defined('DBNAME') && defined('DBUSER') && defined('DBPASS')) {
    try {
        // Construct the DSN string using sprintf for clarity
        $dsn = sprintf("%s:host=%s;dbname=%s;charset=utf8", DBDRIVER, DBHOST, DBNAME);

        // Define PDO options for enhanced security:
        $options = [
            // Throw exceptions on errors for proper error handling
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            // Fetch associative arrays by default
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            // Disable emulated prepared statements to use native prepared statements
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        // Create a new PDO instance with the DSN, username, password, and options
        $pdo = new PDO($dsn, DBUSER, DBPASS, $options);

        // Optionally log the successful connection (avoid echoing sensitive info in production)
        // error_log("Database connection successful!");
        
    } catch (PDOException $e) {
        // Log the detailed error message for debugging purposes
        die("Database connection failed: " . $e->getMessage());
    }
    
}
