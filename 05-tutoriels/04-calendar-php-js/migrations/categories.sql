CREATE TABLE categories (
   id INT AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(255) NOT NULL,
   slug VARCHAR(255) NOT NULL
) ENGINE = 'MyISAM';


INSERT INTO categories (name, slug) VALUES
('Wordpress', 'wordpress'),
('CakePHP', 'cakephp'),
('Photoshop', 'photoshop');