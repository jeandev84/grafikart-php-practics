INSERT INTO category (name, slug)
VALUES ('Categorie #1', 'categorie-1'), ('Categorie #2', 'categorie-2');


INSERT INTO post (name, slug, content, created_at)
VALUES ('Article de test', 'article-test', 'lorem ipsum', '2019-05-11 14:00:00');


INSERT INTO post_category (post_id, category_id)
VALUES (1, 1), (1, 2);

SELECT * FROM post_category pc
LEFT JOIN category c ON pc.category_id = c.id
WHERE pc.post_id = 1;