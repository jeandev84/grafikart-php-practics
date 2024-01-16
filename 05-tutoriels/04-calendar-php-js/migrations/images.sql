CREATE TABLE images (
   id INT AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(255) NOT NULL,
   work_id INTEGER,
   INDEX work_id_idx (work_id)
) ENGINE = 'MyISAM';