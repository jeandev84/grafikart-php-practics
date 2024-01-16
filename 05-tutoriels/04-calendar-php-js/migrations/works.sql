CREATE TABLE works (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    content LONGTEXT,
    category_id INTEGER,
    INDEX category_id_idx (category_id)
) ENGINE = 'MyISAM';


ALTER TABLE `works`
ADD COLUMN `image_id` VARCHAR(255),
ADD INDEX `image_id_idx` (`image_id`);