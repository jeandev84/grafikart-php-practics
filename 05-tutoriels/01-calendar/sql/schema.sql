CREATE TABLE events (
   id INT PRIMARY KEY AUTO_INCREMENT,
   name VARCHAR(255),
   description TEXT,
   start_at DATETIME NOT NULL,
   end_at  DATETIME NOT NULL
);
