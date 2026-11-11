# Jeu de données fictives FasoBusiness Coteamdev

À utiliser uniquement dans une base de test **vierge**, jamais en production.

1. Importer `schema.sql`.
2. Importer `upgrade_v2.sql` (si votre MySQL ne prend pas en charge `ADD COLUMN IF NOT EXISTS`, adapter cette migration).
3. Importer `demo_fictif.sql`.
4. Connexion : `demo@fasobusiness.test` / `FasoDemo@2026!`.
5. Changer le mot de passe si la démo est accessible sur Internet ; préférer un serveur local.

Le jeu crée 1 entreprise, 1 propriétaire, 20 produits, 12 clients, 60 ventes avec lignes, 24 dépenses, mouvements de stock et un abonnement d'essai. Les données et paiements sont fictifs. Aucune coordonnée réelle.

## Nettoyage

`supprimer_demo.sql` contient une requête de contrôle et une requête DELETE commentée : examiner le résultat avant de décommenter. Pour supprimer intégralement une **base exclusivement de test**, exporter ce que vous souhaitez conserver puis supprimer cette base dans phpMyAdmin. Ne jamais supprimer une base partagée avec de vraies entreprises.

## Précautions

Le script n'est pas idempotent : il crée une nouvelle entreprise fictive à chaque import. Ne pas exécuter plusieurs fois. Les montants sont illustratifs en FCFA, pas des prix de marché certifiés.
