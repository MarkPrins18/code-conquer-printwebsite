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
$router->get('/login',      [AuthController::class, 'showLogin']);
$router->post('/login',     [AuthController::class, 'handleLogin']);
$router->get('/logout',    [AuthController::class, 'logout']);
$router->get('/forgot-password', [AuthController::class, 'showForgotPassword']);
$router->post('/forgot-password', [AuthController::class, 'handleForgotPassword']); 
$router->get('/reset-password', [AuthController::class, 'showResetPassword']);
$router->post('/reset-password', [AuthController::class, 'handleResetPassword']);   


// urls for logged in users, can be guarded by a islogged in check
$router->get('/orders',      [OrderController::class, 'index']);
$router->get('/orders/{id}', [OrderController::class, 'show']);

// admin urls here


