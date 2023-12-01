-- Table : posts
DROP TABLE posts;
CREATE TABLE posts (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT DEFAULT NULL,
    created_at DATETIME default CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

INSERT INTO posts (title) VALUES ('Mon titre'), ('Mon titre'), ('Mon titre');