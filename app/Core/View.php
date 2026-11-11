<?php
final class View { public static function render(string $name,array $data=[]):void{extract($data);$view=dirname(__DIR__).'/Views/'.$name.'.php';if(!is_file($view))throw new RuntimeException('View not found');require dirname(__DIR__).'/Views/layout.php';} }
