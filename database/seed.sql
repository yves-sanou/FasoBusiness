USE fasobusiness;
-- Compte de démonstration : demo@fasobusiness.bf / Demo@2026
-- À utiliser uniquement en local ; changez immédiatement le mot de passe en production.
INSERT INTO companies(name,sector,city,created_at) VALUES('Boutique Démo Faso','Commerce','Ouagadougou',NOW());
INSERT INTO users(company_id,name,email,password,role,status,created_at) VALUES(1,'Administrateur Démo','demo@fasobusiness.bf','$2y$12$PEoWM486NaKGnB6OGcMk8.UaaRiyg1urt5WkvDgBwWcptd3LS8ARa','owner','active',NOW());
INSERT INTO products(company_id,sku,name,category,buy_price,sell_price,stock,alert_stock,created_at) VALUES(1,'RIZ-001','Riz local 25 kg','Alimentation',10000,12500,20,5,NOW()),(1,'HUI-001','Huile végétale 5 L','Alimentation',4500,5500,12,4,NOW());
