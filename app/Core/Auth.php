<?php
final class Auth {
 public static function user():?array{return $_SESSION['user']??null;}
 public static function check():bool{return self::user()!==null;}
 public static function require():void{if(!self::check()){flash('error','Veuillez vous connecter.');redirect('/login');}}
 public static function login(array $u):void{session_regenerate_id(true);$_SESSION['user']=$u;}
 public static function logout():void{$_SESSION=[];session_destroy();}
 public static function tenant():int{return (int)(self::user()['company_id']??0);}
}
