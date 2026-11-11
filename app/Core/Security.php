<?php
final class Security {
 public static function headers():void {header('X-Content-Type-Options: nosniff');header('X-Frame-Options: SAMEORIGIN');header('Referrer-Policy: strict-origin-when-cross-origin');header('Permissions-Policy: geolocation=(), camera=(), microphone=()');}
 public static function audit(string $action,?string $entity=null,?int $entityId=null,array $details=[]):void {try{db_exec('INSERT INTO audit_logs(company_id,user_id,action,entity,entity_id,ip_address,details,created_at) VALUES(?,?,?,?,?,?,?,NOW())',[Auth::tenant()?:null,Auth::user()['id']??null,$action,$entity,$entityId,$_SERVER['REMOTE_ADDR']??null,json_encode($details,JSON_UNESCAPED_UNICODE)]);}catch(Throwable $e){error_log('Audit log: '.$e->getMessage());}}
 public static function role(array $allowed):void {Auth::require();if(!in_array(Auth::user()['role']??'', $allowed,true)){http_response_code(403);exit('Accès non autorisé.');}}
}
