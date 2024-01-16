/*
CREATE TABLE img (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  image VARCHAR(255) DEFAULT NULL,
  price FLOAT DEFAULT 0,
  rating INTEGER DEFAULT 0,
  category_id INT
);
*/

DROP TABLE IF EXISTS products;
CREATE TABLE IF NOT EXISTS products (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  price FLOAT DEFAULT 0
);

INSERT INTO products (name, price)
VALUES ('Tourelle de Defense', 150.20), ('Tourelle de niveau 3', 125);