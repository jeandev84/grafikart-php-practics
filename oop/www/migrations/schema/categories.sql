-- Table : categories
DROP TABLE IF EXISTS categories;
CREATE TABLE IF NOT EXISTS categories (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
);

INSERT INTO categories (title) VALUES ('Piscine'), ('Longboard');