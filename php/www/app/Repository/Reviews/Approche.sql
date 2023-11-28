/*
 * ceil: arrondi au nombre superieur
 * floor: arrondi au nombre inferieur
*/

/*
dump($categories);

# BAD QUERY
$sql = "
SELECT p.*, c.*
FROM post p
LEFT JOIN post_category pc ON pc.id = p.id
LEFT JOIN category c ON c.id = pc.category_id
ORDER BY created_at DESC
LIMIT 12";

# OPTIMIZED
$sql = "
SELECT c.*, pc.post_id
FROM post_category pc
JOIN category c ON c.id = pc.category_id
WHERE pc.post_id IN (6, 50, 42)";
*/
