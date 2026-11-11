<?php
if(PHP_SAPI!=='cli'){http_response_code(404);exit;}
require dirname(__DIR__).'/app/bootstrap.php';
$email=strtolower(trim($argv[1]??''));if(!filter_var($email,FILTER_VALIDATE_EMAIL)){fwrite(STDERR,"Usage: php scripts/promote_superadmin.php email\n");exit(1);}
$u=db_one('SELECT id FROM users WHERE email=?',[$email]);if(!$u){fwrite(STDERR,"Utilisateur introuvable. Créez d'abord son compte propriétaire.\n");exit(1);}
Database::p()->prepare('UPDATE users SET role="superadmin",company_id=NULL WHERE id=?')->execute([$u['id']]);echo "Compte superadmin activé pour {$email}.\n";
