# FasoBusiness

**Plateforme de gestion commerciale et de facturation**

FasoBusiness est un projet de plateforme web destiné à accompagner les petites entreprises dans la gestion de leur activité commerciale. Le dépôt sert à centraliser le code source, la documentation et les évolutions du projet.

> **État du dépôt :** initialisation et documentation. Les fonctionnalités ci-dessous décrivent le périmètre fonctionnel visé ; elles ne doivent pas être considérées comme déjà implémentées tant que le code correspondant n'est pas présent.

## Objectifs fonctionnels

- Gérer les utilisateurs et les rôles (administrateur, gestionnaire, etc.).
- Enregistrer et suivre les clients.
- Gérer un catalogue de produits et services.
- Suivre les ventes et les paiements.
- Préparer et gérer les factures.
- Consulter un tableau de bord avec les indicateurs essentiels.

## Technologies envisagées

- **Back-end :** PHP
- **Base de données :** MySQL
- **Accès aux données :** PDO
- **Front-end :** HTML, CSS, JavaScript et Bootstrap
- **Architecture :** MVC

La stack sera précisée et mise à jour au fur et à mesure de l'intégration du code.

## Architecture cible

```text
FasoBusiness/
├── app/
│   ├── controllers/
│   ├── models/
│   └── views/
├── config/
├── database/
│   ├── schema.sql
│   └── seed.sql
├── public/
│   └── assets/
├── routes/
├── storage/
├── .gitignore
└── README.md
```

Cette arborescence est une proposition d'organisation et pourra évoluer avec l'implémentation.

## Installation (à compléter)

Les instructions d'installation seront ajoutées lorsque le code applicatif et les scripts SQL seront disponibles.

## Sécurité

- Utiliser des requêtes préparées pour les accès à la base de données.
- Vérifier les autorisations côté serveur pour chaque action protégée.
- Hacher les mots de passe avec les fonctions adaptées de PHP (`password_hash` et `password_verify`).
- Ne jamais publier de mots de passe, clés API ou fichiers de configuration contenant des secrets.
- Ajouter une protection CSRF et une validation des données dans les formulaires.

## Auteur

**Yves Sanou — Coteamdev**

- Portfolio : https://portfolio.coteamdev.tech
- GitHub : https://github.com/yves-sanou

---

Projet en cours de structuration. La documentation sera actualisée à mesure que les modules seront développés.