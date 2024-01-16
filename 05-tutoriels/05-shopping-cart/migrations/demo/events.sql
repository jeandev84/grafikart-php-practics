CREATE TABLE events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    date DATE NOT NULL
);


INSERT INTO events (title, date) VALUES
('My first event', '2024-01-21'),
('My second event', '2024-01-24');