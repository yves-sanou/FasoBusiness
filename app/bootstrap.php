<?php
declare(strict_types=1);
if (session_status() !== PHP_SESSION_ACTIVE) { $secure=(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!=='off'); session_set_cookie_params(['lifetime'=>0,'path'=>'/','secure'=>$secure,'httponly'=>true,'samesite'=>'Lax']); session_start(); }
require_once __DIR__.'/Core/Database.php'; require_once __DIR__.'/Core/Router.php'; require_once __DIR__.'/Core/Auth.php'; require_once __DIR__.'/Core/View.php'; require_once __DIR__.'/Core/helpers.php'; require_once __DIR__.'/Core/Security.php'; Security::headers();
$config=require dirname(__DIR__).'/config/config.php';
Database::connect($config['database']);
