# FasoBusiness by Coteamdev — V2 Commerciale

SaaS de gestion commerciale multi-entreprises pour TPE/PME du Burkina Faso (XOF/FCFA). Stack : PHP 8.2+, MySQL 8+, Apache, MVC sans dépendance PHP tierce.

## Modules inclus
- Authentification, sessions durcies, mots de passe hachés, CSRF, séparation des données par entreprise.
- Tableau de bord, catalogue, seuils de stock, import/export CSV, clients, ventes multi-articles, factures imprimables, dépenses et rapports.
- PWA installable (HTTPS requis pour le mode hors ligne).
- Offres SaaS Découverte / Professionnel / Entreprise, demande d'abonnement et historique de transactions.
- Espace équipe (owner, manager, cashier) et limites de comptes liées à l'offre.
- Console super-administrateur, suivi des entreprises et validation manuelle des règlements.
- Journal d'audit, mouvements de stock et configuration société (IFU, coordonnées, secteur).

## Installation neuve
1. Héberger le projet avec `public/` comme DocumentRoot (ne jamais exposer `app/`, `config/` ou `database/`).
2. Créer une base MySQL 8 et importer `database/schema.sql`, puis `database/upgrade_v2.sql`.
3. Copier `config/config.example.php` vers `config/config.php` (ou éditer le fichier existant) et renseigner DB, URL et `base_path`.
4. Accorder à PHP uniquement les droits nécessaires. Configurer HTTPS, sauvegardes, logs et cron.
5. Ouvrir `/register` et créer l'entreprise propriétaire. Une période d'essai de 14 jours est créée si le plan Découverte existe.

## Mise à niveau depuis V1
Faire une sauvegarde complète, puis importer uniquement `database/upgrade_v2.sql` dans la base existante. Déployer ensuite le nouveau code. Vérifier les colonnes et les plans avant réouverture.

## Créer le compte super-administrateur
Ne jamais ouvrir une inscription superadmin publique. Après création d'un compte normal, exécuter en CLI :
`php scripts/promote_superadmin.php adresse@coteamdev.tech`
Le script ne fonctionne pas via HTTP.

## Abonnements et paiements
Les prix par défaut (XOF) sont des valeurs de lancement à valider commercialement. Les demandes d'abonnement créent une transaction `pending`; le superadmin confirme le règlement dans `/admin`. Aucun paiement Mobile Money automatique n'est simulé. Pour l'automatiser, obtenir un compte marchand et intégrer les API officielles d'un agrégateur/opérateur (webhooks signés, idempotence, rapprochement, remboursements) en renseignant les secrets via variables d'environnement. Ne jamais confirmer un paiement sur la seule base d'une capture d'écran.

## Fiscalité et conformité
Les factures de cette version sont des documents commerciaux imprimables. Avant usage comme factures fiscales, faire valider les mentions, numérotation, règles TVA, IFU et éventuelles exigences de facturation électronique par un expert-comptable et la DGI du Burkina Faso. Le logiciel ne prétend pas être certifié DGI ni fournir une comptabilité SYSCOHADA complète.

## Paramètres de production obligatoires
- HTTPS partout, `display_errors=Off`, logs privés, sauvegardes chiffrées quotidiennes et tests de restauration.
- Secrets DB uniques, accès DB limité, mises à jour PHP/MySQL, pare-feu et surveillance.
- SMTP transactionnel configuré avant activation des e-mails de récupération.
- Contrat de service, CGU, politique de confidentialité, durée de conservation, procédure d'export/suppression et conformité loi burkinabè sur les données personnelles.
- Tests fonctionnels, tests multi-tenant, tests de charge et audit sécurité indépendant.

## Limites assumées
- Mobile Money réel non connecté (identifiants marchand requis).
- Pas de certification fiscale/DGI, comptabilité SYSCOHADA complète, rapprochement bancaire, multi-entrepôts, avoirs/retours avancés ni synchronisation offline des écritures.
- Les rôles équipe sont une première couche ; prévoir une matrice d'autorisations granulaire avant d'ouvrir l'accès à de grandes équipes.

## Données de démonstration
`database/seed.sql` est facultatif. Ne jamais réutiliser des identifiants de démonstration en production.
