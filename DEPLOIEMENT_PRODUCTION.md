# Déploiement Coteamdev — checklist de mise en production

## Serveur
- PHP 8.2+ avec extensions pdo_mysql, mbstring, openssl, fileinfo et Apache mod_rewrite.
- MySQL 8.0.29+ recommandé (la migration utilise `ADD COLUMN IF NOT EXISTS`).
- DocumentRoot configuré sur le seul dossier `public/`.
- Variables d'environnement : APP_URL, APP_BASE_PATH, APP_TIMEZONE, DB_HOST, DB_NAME, DB_USER, DB_PASSWORD.
- HTTPS valide, redirection HTTP→HTTPS, sauvegardes chiffrées et test de restauration.

## Déploiement initial
1. Créer un utilisateur MySQL dédié, sans privilège global.
2. Importer `database/schema.sql`, puis `database/upgrade_v2.sql`.
3. Définir les variables d'environnement et vérifier l'accès DB.
4. Créer le premier compte depuis `/register`.
5. Promouvoir le compte Coteamdev par SSH/CLI avec le script prévu.
6. Tester les parcours : inscription, vente, stock, facture, abonnement, paiement et cloisonnement entre deux entreprises.
7. Configurer sauvegardes, supervision, logs et procédure support.

## Avant facturation publique
- Remplacer la validation manuelle par l'API d'un agrégateur Mobile Money contracté (ex. opérateur/agrégateur local). Ajouter signature de webhook, idempotence, rapprochement et gestion des remboursements.
- Faire valider les factures, numérotation, fiscalité/TVA, IFU et obligations d'e-facturation par la DGI ou un conseil fiscal local.
- Publier CGU, politique de confidentialité, mentions légales, politique de rétention et conditions de support.
- Réaliser un audit indépendant, tests d'intrusion et tests de restauration.

**État de livraison :** code V2 renforcé et prêt pour installation pilote. La mise en vente à grande échelle est conditionnée aux validations externes ci-dessus ; aucune certification DGI ni intégration Mobile Money réelle n'est revendiquée.
