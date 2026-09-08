<?php
/**
 * Antara Globale - Local Development Router for PHP Built-in Web Server
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Serve static assets and existing physical files directly
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Clean Top-level Pages
if ($uri === '/about' || $uri === '/about/') {
    require __DIR__ . '/about.php';
    exit;
}
if ($uri === '/contact' || $uri === '/contact/') {
    require __DIR__ . '/contact.php';
    exit;
}
if ($uri === '/blog' || $uri === '/blog/') {
    require __DIR__ . '/blog.php';
    exit;
}
if ($uri === '/export-supply' || $uri === '/export-supply/') {
    require __DIR__ . '/export-supply.php';
    exit;
}
if ($uri === '/restaurant-cafe-supply' || $uri === '/restaurant-cafe-supply/') {
    require __DIR__ . '/restaurant-cafe-supply.php';
    exit;
}

// Category-based Clean Product Route: /export/{slug}, /restaurant/{slug}, /horeca/{slug}, /product/{slug}
if (preg_match('#^/(export|restaurant|horeca|product)/([a-zA-Z0-9_-]+)/?$#', $uri, $matches)) {
    $_GET['slug'] = $matches[2];
    require __DIR__ . '/product-detail.php';
    exit;
}

// Clean Blog Route: /blog/{slug}
if (preg_match('#^/blog/([a-zA-Z0-9_-]+)/?$#', $uri, $matches)) {
    $_GET['slug'] = $matches[1];
    require __DIR__ . '/blog-detail.php';
    exit;
}

// Fallback to index.php
require __DIR__ . '/index.php';
