CREATE TABLE IF NOT EXISTS %dbprefix%version ( id INT NOT NULL AUTO_INCREMENT,current_version varchar(11) NOT NULL,  PRIMARY KEY (id)); 
CREATE TABLE IF NOT EXISTS %dbprefix%user_categories ( id int(11) NOT NULL AUTO_INCREMENT, category_name VARCHAR(50) NOT NULL, PRIMARY KEY (id));
CREATE TABLE IF NOT EXISTS %dbprefix%users ( userid int(11) NOT NULL AUTO_INCREMENT, name varchar(255) DEFAULT NULL, username varchar(25) DEFAULT NULL, password varchar(255) NOT NULL, category_id int(11) NOT NULL,is_active INT(1) NOT NULL DEFAULT '1', PRIMARY KEY (userid), UNIQUE KEY username (username), INDEX par_ind(category_id), FOREIGN KEY (category_id) REFERENCES %dbprefix%user_categories(id) ON DELETE SET NULL );
CREATE TABLE IF NOT EXISTS %dbprefix%modules ( module_id int(11) NOT NULL AUTO_INCREMENT, module_name varchar(50) UNIQUE NOT NULL, module_display_name varchar(50) NOT NULL, module_description varchar(150) NOT NULL, module_status int(1) NOT NULL, PRIMARY KEY (module_id),module_version VARCHAR(10) NULL, license_key VARCHAR(100) NULL, license_status VARCHAR(100) NULL,required_modules VARCHAR(250) NULL );
CREATE TABLE IF NOT EXISTS %dbprefix%navigation_menu ( id int(11) NOT NULL AUTO_INCREMENT, menu_name varchar(250) UNIQUE, parent_name varchar(250) NOT NULL,menu_order int(11) NOT NULL,menu_url varchar(500), menu_icon varchar(100), menu_text varchar(200),required_module VARCHAR(25) NULL, PRIMARY KEY (id) );
CREATE TABLE IF NOT EXISTS %dbprefix%menu_access ( id int(11) NOT NULL AUTO_INCREMENT, menu_name varchar(50) NOT NULL, category_group int(11) NOT NULL, allow tinyint(1), PRIMARY KEY (id), FOREIGN KEY (category_group) REFERENCES %dbprefix%user_categories (id));
CREATE TABLE IF not EXISTS %dbprefix%areas (id int(11) NOT NULL AUTO_INCREMENT, area_name varchar(50), PRIMARY KEY(id));
CREATE TABLE IF not EXISTS %dbprefix%customers ( id int(11) NOT NULL AUTO_INCREMENT, customer_no varchar(100) UNIQUE NOT NULL, first_name varchar(50) NOT NULL, last_name varchar(50) NOT NULL, address varchar(125) NOT NULL, phone_number varchar(50) NOT NULL, area_id int(11) NOT NULL, is_active INT(1) NOT NULL DEFAULT '1', PRIMARY KEY(id), FOREIGN KEY(area_id) REFERENCES %dbprefix%areas(id));
CREATE TABLE IF not EXISTS %dbprefix%subcriptions ( id int(11) NOT NULL AUTO_INCREMENT, sub_name varchar(50) NOT NULL, sub_description varchar (250) NULL, sub_price decimal NOT NULL, PRIMARY KEY(id));
CREATE TABLE IF NOT EXISTS %dbprefix%customer_acc ( id int(11) NOT NULL AUTO_INCREMENT, customer_id int(11) NOT NULL, subcription_id int(11) NOT NULL, starting_date datetime NULL, ending_date datetime NULL, PRIMARY KEY(id));
CREATE TABLE IF NOT EXISTS %dbprefix%language_data ( id INT(11) NOT NULL AUTO_INCREMENT , l_name VARCHAR(25) NOT NULL , l_index VARCHAR(150) NOT NULL , l_value VARCHAR(250) NOT NULL , PRIMARY KEY (id));
INSERT INTO %dbprefix%navigation_menu(menu_name, parent_name, menu_order, menu_url, menu_icon, menu_text, required_module) VALUES ('new_client', 'clientele', '10', 'customer/add_new', NULL, 'Nouveau client', '');
INSERT INTO %dbprefix%navigation_menu(menu_name, parent_name, menu_order, menu_url, menu_icon, menu_text, required_module) VALUES ('all_clients', 'clientele', '20', 'customer/index', NULL, 'Tous les clients', '');
INSERT INTO %dbprefix%navigation_menu(menu_name, parent_name, menu_order, menu_url, menu_icon, menu_text, required_module) VALUES ('contract_manag', 'clientele', '30', 'customer/contracts', NULL, 'Gestion des contracts','');
INSERT INTO %dbprefix%navigation_menu(menu_name, parent_name, menu_order, menu_url, menu_icon, menu_text, required_module) VALUES ('clientele', '', 100, '#', 'fa-users', 'Service Client', '');
INSERT INTO %dbprefix%navigation_menu(menu_name, parent_name, menu_order, menu_url, menu_icon, menu_text, required_module) VALUES ('reports', '', 500, '#', 'fa-line-chart', 'Rapports', '');
INSERT INTO %dbprefix%navigation_menu(menu_name, parent_name, menu_order, menu_url, menu_icon, menu_text, required_module) VALUES ('extras', '', 600, '#', NULL, 'Extras', '');
INSERT INTO %dbprefix%navigation_menu(menu_name, parent_name, menu_order, menu_url, menu_icon, menu_text, required_module) VALUES ('modules', '', 700, '#', NULL, 'Modules', '');
INSERT INTO %dbprefix%navigation_menu(menu_name, parent_name, menu_order, menu_url, menu_icon, menu_text, required_module) VALUES ('administration', '', 800, '#', NULL, 'Administration', '');
INSERT INTO %dbprefix%areas (area_name) VALUES ('Manika');
INSERT INTO %dbprefix%areas (area_name) VALUES ('Dilala');
INSERT INTO %dbprefix%user_categories(category_name) VALUES ('Administrateur système');
INSERT INTO %dbprefix%user_categories(category_name) VALUES ('Administrateur');
INSERT INTO %dbprefix%user_categories(category_name) VALUES ('Comptable');
INSERT INTO %dbprefix%user_categories(category_name) VALUES ('Service client');
INSERT INTO %dbprefix%version (current_version) VALUES ('0.1.0');
INSERT INTO %dbprefix%menu_access (menu_name, category_group, allow) SELECT navigation_menu.menu_name,'Administrateur système', '1' FROM %dbprefix%navigation_menu AS navigation_menu WHERE navigation_menu.menu_name NOT IN (SELECT menu_name FROM %dbprefix%menu_access WHERE category_group = 'Administrateur système');






