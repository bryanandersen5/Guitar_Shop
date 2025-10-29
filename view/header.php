<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css"
          href="/book_apps/ch14_guitar_shop/main.css">
</head>

<!-- the body section -->
<body>
<header><h1>My Guitar Shop</h1>
<?php
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $parts = array_filter(explode('/', $path)); // Explode by '/' and remove empty elements
    echo $path
?></header>
