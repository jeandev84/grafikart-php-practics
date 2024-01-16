CREATE TABLE videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    duration DECIMAL(19,4) NOT NULL
);


INSERT INTO grafikartcsv.videos (id, title, content, duration) VALUES (1, 'Decomposer un site en PHP', '<p>Dans ce tutoriel vous apprendrez a decomposer un site</p>', 1077.3300);
INSERT INTO grafikartcsv.videos (id, title, content, duration) VALUES (2, 'Formulaire de contact CakePHP', '<p>Dans ce tutoriel vous apprendrez a creer un formulaire de contact CakePHP</p>', 1234.7000);
INSERT INTO grafikartcsv.videos (id, title, content, duration) VALUES (3, 'Afficher son dernier Tweet', '<p>Dans ce tutoriel vous apprendrez a afficher son dernier Tweet</p>', 745.2000);
INSERT INTO grafikartcsv.videos (id, title, content, duration) VALUES (4, 'Menu anime avec jQuery', '<p>Dans ce tutoriel vous apprendrez a creer un menu anime avec jQuery</p>', 587.6000);

/*
 CREATE TABLE videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    duration DECIMAL(19,4) NOT NULL,
    vimeo VARCHAR(255),
    daily VARCHAR(255) NOT NULL,
    blip VARCHAR(255) NOT NULL,
    video VARCHAR(255) NOT NULL,
    video_size DECIMAL(19,4) NOT NULL,
    source INTEGER,
    link  VARCHAR(255),
    created_at DATETIME NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
*/