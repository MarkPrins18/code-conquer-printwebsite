DROP ROLE IF EXISTS `admin_role`;
DROP ROLE IF EXISTS `app_user_role`;
DROP ROLE IF EXISTS `data_analyst_role`;

DROP USER IF EXISTS 'admin'@'localhost';
DROP USER IF EXISTS 'app_user'@'localhost';
DROP USER IF EXISTS 'data_analyst'@'localhost';

CREATE ROLE `admin_role`;
CREATE ROLE `app_user_role`;
CREATE ROLE `data_analyst_role`;

-- zelfde rechten als de root
GRANT ALL ON `bouw3d_db`.* TO 'admin_role' WITH GRANT OPTION;

-- permissies van de webapplicatie
GRANT SELECT, INSERT, UPDATE ON `bouw3d_db`.* TO 'app_user_role';
GRANT DELETE ON `bouw3d_db`.`order_line_items` TO `app_user_role`;
GRANT DELETE ON `bouw3d_db`.`password_reset_tokens` TO `app_user_role`;

-- permissies data analyst + VIEW voor users
GRANT SELECT ON `bouw3d_db`.`companies` TO `data_analyst_role`;
GRANT SELECT ON `bouw3d_db`.`roles` TO `data_analyst_role`;
GRANT SELECT ON `bouw3d_db`.`order_statuses` TO `data_analyst_role`;
GRANT SELECT ON `bouw3d_db`.`materials` TO `data_analyst_role`;
GRANT SELECT ON `bouw3d_db`.`view_users` TO `data_analyst_role`;
GRANT SELECT ON `bouw3d_db`.`products` TO `data_analyst_role`;
GRANT SELECT ON `bouw3d_db`.`orders` TO `data_analyst_role`;
GRANT SELECT ON `bouw3d_db`.`order_line_items` TO `data_analyst_role`;
GRANT SELECT ON `bouw3d_db`.`custom_products` TO `data_analyst_role`;
GRANT SELECT ON `bouw3d_db`.`catalog_products` TO `data_analyst_role`;

CREATE USER 'admin'@'localhost' IDENTIFIED BY 'password';
CREATE USER 'app_user'@'localhost' IDENTIFIED BY 'password';
CREATE USER 'data_analyst'@'localhost' IDENTIFIED BY 'password';

GRANT `admin_role` TO 'admin'@'localhost';
GRANT `app_user_role` TO 'app_user'@'localhost';
GRANT `data_analyst_role` TO 'data_analyst'@'localhost';

-- Gebruik 'FOR' voor Windows / Nieuwere MariaDB
-- Gebruik 'TO' voor Mac / Oudere MariaDB of MySQL
-- Als 'FOR' niet werkt, verander het handmatig naar 'TO'
SET DEFAULT ROLE `admin_role` FOR 'admin'@'localhost';
SET DEFAULT ROLE `app_user_role` FOR 'app_user'@'localhost';
SET DEFAULT ROLE `data_analyst_role` FOR 'data_analyst'@'localhost';

FLUSH PRIVILEGES;