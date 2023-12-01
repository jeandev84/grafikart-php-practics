-- Table : posts
DROP TABLE IF EXISTS posts;
CREATE TABLE IF NOT EXISTS posts (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT DEFAULT NULL,
    created_at DATETIME default CURRENT_TIMESTAMP,
    category_id INTEGER DEFAULT NULL,
    CONSTRAINT fk_categories FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE ON UPDATE RESTRICT,
    PRIMARY KEY (id)
);

INSERT INTO posts (title) VALUES ('Mon titre'), ('Mon titre'), ('Mon titre');

DROP TABLE IF EXISTS categories;
CREATE TABLE IF NOT EXISTS categories (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) DEFAULT NULL
);