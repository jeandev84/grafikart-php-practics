-- DROP TABLE categories CASCADE;
CREATE TABLE categories (
                            id INT NOT NULL AUTO_INCREMENT,
                            title VARCHAR(255) DEFAULT NULL,
                            PRIMARY KEY (id)
);


-- DROP TABLE posts CASCADE;
CREATE TABLE posts (
                       id INT NOT NULL AUTO_INCREMENT,
                       title VARCHAR(255) NOT NULL,
                       content LONGTEXT DEFAULT NULL,
                       created_at DATETIME default CURRENT_TIMESTAMP,
                       category_id INTEGER DEFAULT NULL,
                       CONSTRAINT fk_categories FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE ON UPDATE RESTRICT,
                       PRIMARY KEY (id)
);

INSERT INTO posts (title, content) VALUES
                                       ('Mon titre', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam dolorem dolores eligendi esse maiores modi officia quia suscipit voluptatum. Architecto cum ducimus itaque nostrum numquam odit perferendis placeat quia, rem veniam. Alias dolorum eius error esse fugit, nesciunt, odio, odit optio quaerat reiciendis repellendus sequi sint unde vel velit vitae?'),
                                       ('Mon titre', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam dolorem dolores eligendi esse maiores modi officia quia suscipit voluptatum. Architecto cum ducimus itaque nostrum numquam odit perferendis placeat quia, rem veniam. Alias dolorum eius error esse fugit, nesciunt, odio, odit optio quaerat reiciendis repellendus sequi sint unde vel velit vitae?'),
                                       ('Mon titre', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam dolorem dolores eligendi esse maiores modi officia quia suscipit voluptatum. Architecto cum ducimus itaque nostrum numquam odit perferendis placeat quia, rem veniam. Alias dolorum eius error esse fugit, nesciunt, odio, odit optio quaerat reiciendis repellendus sequi sint unde vel velit vitae?');


INSERT INTO categories (title) VALUES ('Piscine'), ('Longboard');