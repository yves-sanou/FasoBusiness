<?php
final class Router { private array $routes=[]; public function get(string $p, callable $h):void{$this->routes['GET'][$p]=$h;} public function post(string $p, callable $h):void{$this->routes['POST'][$p]=$h;} public function dispatch(string $m,string $p):void{$h=$this->routes[$m][$p]??null;if(!$h){http_response_code(404);View::render('errors/404');return;} $h();} }
