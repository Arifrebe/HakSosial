<?php
session_start();

include_once 'model/koneksi.php';

// Load a specific page from the given directory
// If the file does not exist, load the 404 error page
function loadPage($directory, $page) {
    $filePath = "views/{$directory}/" . basename($page) . '.view.php';

    if (!file_exists($filePath)) {
        require "404.php";
        return;
    }

    global $pdo;

    require $filePath;
}

// Generate a full URL for assets (CSS, JS, images)
function asset($url) {
    $basePath = dirname($_SERVER['SCRIPT_NAME']); 
    $basePath = rtrim($basePath, '/');
    return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $basePath . '/assets/' . ltrim($url, '/');
}

// Generate a full URL for a given path, considering HTTPS and a defined WEBPATH
function url($path = '') {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $baseUrl = $protocol . '://' . $host;

    if (defined('WEBPATH') && WEBPATH !== '') {
        $baseUrl .= '/' . WEBPATH;
    }
    
    return $baseUrl . '/' . ltrim($path, '/');
}

// Retrieve the request URI and remove the base directory (pictoria)
$requestURI = trim($_SERVER['REQUEST_URI'], '/');
$baseDIR = 'pictoria';

if (str_starts_with($requestURI, $baseDIR)) {
    $requestURI = substr($requestURI, strlen($baseDIR));
}

// Extract URL segments
$urlSegment = explode('/', $requestURI);
$page = $urlSegment[1] ?? 'home';

// If the first segment is 'auth', load an authentication page (default: login)
if ($page === 'auth') {
    $authPage = $urlSegment[2] ?? 'login';
    loadPage('auth', $authPage);
} else {
    // Check if the user is an admin and load the corresponding user or admin page
    $isAdmin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    $directory = $isAdmin ? 'admin' : 'user';
    loadPage($directory, $page);
}
