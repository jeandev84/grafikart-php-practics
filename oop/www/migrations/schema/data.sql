-- Table : articles
DROP TABLE articles;
CREATE TABLE articles (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT DEFAULT NULL,
    created_at DATETIME default CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);