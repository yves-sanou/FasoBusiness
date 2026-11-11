<?php
declare(strict_types=1);
require dirname(__DIR__).'/app/bootstrap.php';
$router = new Router();
require dirname(__DIR__).'/app/routes.php';
$path=parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';$base=rtrim($config['app']['base_path']??'','/');if($base!=='' && str_starts_with($path,$base))$path=substr($path,strlen($base))?:'/';$router->dispatch($_SERVER['REQUEST_METHOD'], $path);
