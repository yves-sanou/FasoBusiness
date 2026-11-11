USE fasobusiness;
CREATE TABLE IF NOT EXISTS plans(id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, code VARCHAR(40) UNIQUE NOT NULL, name VARCHAR(100) NOT NULL, price_month DECIMAL(14,2) NOT NULL DEFAULT 0, price_year DECIMAL(14,2) NOT NULL DEFAULT 0, max_users INT NOT NULL DEFAULT 1, max_products INT NOT NULL DEFAULT 100, features JSON NULL, active TINYINT(1) NOT NULL DEFAULT 1) ENGINE=InnoDB;
INSERT IGNORE INTO plans(code,name,price_month,price_year,max_users,max_products,features) VALUES
('starter','Découverte',0,0,1,100,JSON_ARRAY('Produits','Clients','Ventes','Factures')),
('pro','Professionnel',5000,50000,5,2000,JSON_ARRAY('Toutes les fonctions','Équipe','Rapports avancés','Import CSV')),
('business','Entreprise',12000,120000,20,10000,JSON_ARRAY('Toutes les fonctions','Équipe étendue','Exports','Support prioritaire'));
CREATE TABLE IF NOT EXISTS subscriptions(id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,company_id BIGINT UNSIGNED NOT NULL,plan_id BIGINT UNSIGNED NOT NULL,status ENUM('trial','active','pending','expired','cancelled') NOT NULL DEFAULT 'trial',billing_cycle ENUM('monthly','yearly') NOT NULL DEFAULT 'monthly',starts_at DATETIME NOT NULL,ends_at DATETIME NULL,created_at DATETIME NOT NULL,INDEX(company_id,status),FOREIGN KEY(company_id) REFERENCES companies(id) ON DELETE CASCADE,FOREIGN KEY(plan_id) REFERENCES plans(id)) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS payment_transactions(id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,company_id BIGINT UNSIGNED NOT NULL,subscription_id BIGINT UNSIGNED NULL,provider VARCHAR(40) NOT NULL DEFAULT 'manual',provider_reference VARCHAR(150) NULL,amount DECIMAL(14,2) NOT NULL,currency CHAR(3) NOT NULL DEFAULT 'XOF',status ENUM('initiated','pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',metadata JSON NULL,created_at DATETIME NOT NULL,paid_at DATETIME NULL,INDEX(company_id,status),FOREIGN KEY(company_id) REFERENCES companies(id) ON DELETE CASCADE,FOREIGN KEY(subscription_id) REFERENCES subscriptions(id) ON DELETE SET NULL) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS stock_movements(id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,company_id BIGINT UNSIGNED NOT NULL,product_id BIGINT UNSIGNED NOT NULL,user_id BIGINT UNSIGNED NULL,type ENUM('in','out','adjustment') NOT NULL,quantity INT NOT NULL,reason VARCHAR(190),created_at DATETIME NOT NULL,INDEX(company_id,created_at),FOREIGN KEY(company_id) REFERENCES companies(id) ON DELETE CASCADE,FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE,FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE SET NULL) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS audit_logs(id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,company_id BIGINT UNSIGNED NULL,user_id BIGINT UNSIGNED NULL,action VARCHAR(100) NOT NULL,entity VARCHAR(80) NULL,entity_id BIGINT NULL,ip_address VARCHAR(45) NULL,details JSON NULL,created_at DATETIME NOT NULL,INDEX(company_id,created_at),FOREIGN KEY(company_id) REFERENCES companies(id) ON DELETE SET NULL,FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE SET NULL) ENGINE=InnoDB;
ALTER TABLE users ADD COLUMN IF NOT EXISTS phone VARCHAR(40) NULL;
ALTER TABLE companies ADD COLUMN IF NOT EXISTS tax_rate DECIMAL(5,2) NOT NULL DEFAULT 0;
ALTER TABLE sales ADD COLUMN IF NOT EXISTS subtotal DECIMAL(14,2) NOT NULL DEFAULT 0;
ALTER TABLE sales ADD COLUMN IF NOT EXISTS tax_amount DECIMAL(14,2) NOT NULL DEFAULT 0;
ALTER TABLE sales ADD COLUMN IF NOT EXISTS discount_amount DECIMAL(14,2) NOT NULL DEFAULT 0;
ALTER TABLE sales ADD COLUMN IF NOT EXISTS notes TEXT NULL;
ALTER TABLE sales ADD COLUMN IF NOT EXISTS updated_at DATETIME NULL;
ALTER TABLE products ADD COLUMN IF NOT EXISTS unit VARCHAR(30) NOT NULL DEFAULT 'unité';
ALTER TABLE products ADD COLUMN IF NOT EXISTS barcode VARCHAR(100) NULL;
ALTER TABLE customers ADD COLUMN IF NOT EXISTS notes TEXT NULL;
