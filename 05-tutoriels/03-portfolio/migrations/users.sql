CREATE TABLE users (
   id INT AUTO_INCREMENT PRIMARY KEY,
   username VARCHAR(255) NOT NULL,
   password VARCHAR(255) NOT NULL
) ENGINE = 'MyISAM';


INSERT INTO users (username, password)
VALUES ('admin', sha1('admin')); # admin (pswd)
