<?php
require_once dirname(__DIR__).'/app/Controllers/AuthController.php'; require_once dirname(__DIR__).'/app/Controllers/DashboardController.php'; require_once dirname(__DIR__).'/app/Controllers/BusinessController.php'; require_once dirname(__DIR__).'/app/Controllers/AdminController.php'; require_once dirname(__DIR__).'/app/Controllers/SubscriptionController.php'; require_once dirname(__DIR__).'/app/Controllers/TeamController.php';
$auth=new AuthController();$dash=new DashboardController();$biz=new BusinessController();$admin=new AdminController();$sub=new SubscriptionController();$team=new TeamController();
$router->get('/',fn()=>Auth::check()?$dash->index():redirect('/login'));
$router->get('/login',fn()=>$auth->loginForm());$router->post('/login',fn()=>$auth->login());$router->get('/register',fn()=>$auth->registerForm());$router->post('/register',fn()=>$auth->register());$router->post('/logout',fn()=>$auth->logout());
$router->get('/dashboard',fn()=>$dash->index());
$router->get('/products',fn()=>$biz->products());$router->get('/products/create',fn()=>$biz->productForm());$router->post('/products/save',fn()=>$biz->saveProduct());$router->post('/products/delete',fn()=>$biz->deleteProduct());$router->get('/products/export',fn()=>$biz->exportProducts());$router->post('/products/import',fn()=>$biz->importProducts());
$router->get('/customers',fn()=>$biz->customers());$router->post('/customers/save',fn()=>$biz->saveCustomer());
$router->get('/sales',fn()=>$biz->sales());$router->get('/sales/create',fn()=>$biz->saleForm());$router->post('/sales/save',fn()=>$biz->saveSale());$router->get('/invoices',fn()=>$biz->invoices());$router->get('/invoice',fn()=>$biz->invoice());
$router->get('/expenses',fn()=>$biz->expenses());$router->post('/expenses/save',fn()=>$biz->saveExpense());$router->get('/reports',fn()=>$biz->reports());
$router->get('/settings',fn()=>$biz->settings());$router->post('/settings/save',fn()=>$biz->saveSettings());$router->get('/admin',fn()=>$admin->index());

$router->get('/subscription',fn()=>$sub->index());$router->post('/subscription/request',fn()=>$sub->request());$router->get('/team',fn()=>$team->index());$router->post('/team/save',fn()=>$team->save());$router->post('/team/status',fn()=>$team->status());$router->post('/admin/payment/confirm',fn()=>$admin->confirmPayment());

$router->get('/stock',fn()=>$biz->stock());$router->post('/stock/adjust',fn()=>$biz->adjustStock());
