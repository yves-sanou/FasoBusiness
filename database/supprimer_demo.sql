-- Suppression de la SEULE entreprise fictive identifiée par son email de connexion.
-- Vérifiez d'abord le SELECT. Ne pas utiliser si vous avez converti ce compte en compte réel.
USE fasobusiness;
SELECT c.id,c.name,u.email FROM companies c JOIN users u ON u.company_id=c.id WHERE u.email='demo@fasobusiness.test';
-- Décommenter uniquement après vérification :
-- DELETE c FROM companies c JOIN users u ON u.company_id=c.id WHERE u.email='demo@fasobusiness.test' AND c.name='Faso Marché Démonstration [TEST]';
-- Les tables liées sont supprimées par ON DELETE CASCADE ; les audit_logs avec SET NULL peuvent subsister.
