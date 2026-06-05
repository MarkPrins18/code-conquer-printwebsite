<?php

//Guest urls
$router->get('/',           [PageController::class,    'home']);
$router->get('/about-us',   [PageController::class,    'about']);
$router->get('/services',   [PageController::class,    'services']);
$router->get('/contact',    [ContactController::class, 'index']);
$router->post('/contact',   [ContactController::class, 'send']);
$router->get('/products',     [ProductController::class, 'index']);
$router->get('/api/products', [ProductController::class, 'getJson']);
$router->get('/register',   [AuthController::class, 'showRegister']);
$router->post('/register',  [AuthController::class, 'handleRegister']);


// urls for logged in users, can be guarded by a islogged in check
$router->get('/orders',      [OrderController::class, 'index']);
$router->get('/orders/{id}', [OrderController::class, 'show']);

// admin urls here


