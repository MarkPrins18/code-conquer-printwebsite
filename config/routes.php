<?php

//Guest urls
$router->get('/',           [PageController::class,    'home']);
$router->get('/about-us',   [PageController::class,    'about']);
$router->get('/services',   [PageController::class,    'services']);
$router->get('/contact',    [ContactController::class, 'index']);
$router->post('/contact',   [ContactController::class, 'send']);
$router->get('/products',     [ProductController::class, 'index']);
// $router->get('/get-products-json', [ProductController::class, 'getJson']);
$router->get('/register',   [AuthController::class, 'showRegister']);
$router->post('/register',  [AuthController::class, 'handleRegister']);


// urls for logged in users, can be guarded by a islogged in check
$router->get('/orders',      [OrderController::class, 'index']);
$router->get('/orders/{id}', [OrderController::class, 'show']);

// admin urls here
$router->get('/admin', [DashboardController::class, 'index']);
$router->get('/admin/products',        [AdminProductController::class, 'index']);
$router->get('/admin/products/create', [AdminProductController::class, 'create']);
$router->post('/admin/products',       [AdminProductController::class, 'store']);
$router->get('/admin/searchlogs',      [AdminSearchLogController::class, 'index']);
$router->post('/admin/searchlogs/delete',      [AdminSearchLogController::class, 'deleteLogs']);
