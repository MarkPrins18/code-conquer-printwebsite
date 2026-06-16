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
$router->get('/admin', [DashboardController::class, 'index']);
$router->get('/admin/orders',              [AdminOrderController::class, 'index']);
$router->get('/admin/orders/{id}',         [AdminOrderController::class, 'show']);
$router->post('/admin/orders/update-status', [AdminOrderController::class, 'updateStatus']);
$router->post('/admin/orders/delete',        [AdminOrderController::class, 'deleteOrder']);
$router->get('/admin/products',        [AdminProductController::class, 'index']);
$router->get('/admin/products/create', [AdminProductController::class, 'create']);
$router->post('/admin/products',       [AdminProductController::class, 'store']);
$router->get('/admin/products/import', [AdminProductController::class, 'showCsvUpload']);
$router->post('/admin/products/import',[AdminProductController::class, 'handleCsvUpload']);