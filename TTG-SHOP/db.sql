CREATE TABLE IF NOT EXISTS `groups` (
    group_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    group_name VARCHAR(30) NOT NULL
);

CREATE TABLE IF NOT EXISTS users (
    user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(30) NOT NULL,
    user_email VARCHAR(50) NOT NULL,
    user_pwd VARCHAR (100) NOT NULL,
    group_id INT NOT NULL DEFAULT 1, 
    FOREIGN KEY(group_id) REFERENCES GROUPS(group_id)
);

INSERT INTO groups (group_name) VALUES ('user');
INSERT INTO groups (group_name) VALUES ('employee');
INSERT INTO groups (group_name) VALUES ('admin');

CREATE TABLE IF NOT EXISTS categories (
    category_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR (40) NOT NULL
);

INSERT INTO categories (category_name) VALUES ('karciane');
INSERT INTO categories (category_name) VALUES ('logiczne');
INSERT INTO categories (category_name) VALUES ('przygodowe');
INSERT INTO categories (category_name) VALUES ('rodzinne');
INSERT INTO categories (category_name) VALUES ('strategiczne');
INSERT INTO categories (category_name) VALUES ('imprezowe');
INSERT INTO categories (category_name) VALUES ('akcesoria');

CREATE TABLE IF NOT EXISTS images (
    image_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    image_name VARCHAR(30) NOT NULL,
    image_destination VARCHAR(300) NOT NULL
);

CREATE TABLE IF NOT EXISTS products (
    product_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(40) NOT NULL,
    product_price FLOAT NOT NULL,
    product_quantity INT NOT NULL,
    product_description VARCHAR(400) NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY(category_id) REFERENCES CATEGORIES(category_id)
);

CREATE TABLE IF NOT EXISTS products_images (
    product_id INT NOT NULL,
    image_id INT NOT NULL,
    FOREIGN KEY(product_id) REFERENCES products(product_id),
    FOREIGN KEY(image_id) REFERENCES images(image_id)
);