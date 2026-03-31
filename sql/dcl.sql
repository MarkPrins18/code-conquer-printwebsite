--use drop role when rerunning dcl
--DROP ROLE `admin_role`;
--DROP ROLE `app_user_role`;
--DROP ROLE `data_analyst_role`;

DROP USER IF EXISTS 'admin'@'localhost';
DROP USER IF EXISTS 'app_user'@'localhost';
DROP USER IF EXISTS 'data_analyst'@'localhost';

CREATE ROLE `admin_role`;
CREATE ROLE `app_user_role`;
CREATE ROLE `data_analyst_role`;

-- same privileges as root
GRANT ALL ON `bouw3d_db`.* TO 'admin_role' WITH GRANT OPTION;

-- web application permissions
GRANT SELECT, INSERT, UPDATE ON `bouw3d_db`.* TO 'app_user_role';
GRANT DELETE ON `bouw3d_db`.`order_line_items` TO `app_user_role`;
GRANT DELETE ON `bouw3d_db`.`password_reset_tokens` TO `app_user_role`;

-- data analyst permissions + VIEW for users
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

-- Use 'FOR' for Windows / Newer MariaDB
-- Use 'TO' for Mac / Older MariaDB or MySQL
-- If 'FOR' doesn’t work, manually change it to 'TO'
SET DEFAULT ROLE `admin_role` FOR 'admin'@'localhost';
SET DEFAULT ROLE `app_user_role` FOR 'app_user'@'localhost';
SET DEFAULT ROLE `data_analyst_role` FOR 'data_analyst'@'localhost';

FLUSH PRIVILEGES;