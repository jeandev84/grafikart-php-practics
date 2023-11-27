<?php
# php commands/fill.php
# https://github.com/fzaninotto/Faker
require dirname(__DIR__). '/vendor/autoload.php';


$faker = \Faker\Factory::create('fr_FR');


$pdo = \App\Helpers\Connection::getPdo();

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');


$posts = [];
$categories = [];

echo "Beginning [post]...\n\n";
for ($i = 0; $i < 50; $i++) {

    $name      = $faker->sentence();
    $slug      = $faker->slug;
    $createdAt = $faker->date() .' '. $faker->time();
    $content   = $faker->paragraphs(nb: rand(3, 15), asText: true);

    $sql = "INSERT INTO post SET name='$name', slug='$slug', created_at='$createdAt', content='$content'";
    $pdo->exec($sql);
    $posts[] = $pdo->lastInsertId();

    echo "[". date('d-m-Y H:i:s') . "] : $sql\n";
}
echo "Finished!\n\n";


echo "Beginning [category]...\n\n";
for ($i = 0; $i < 5; $i++) {

    $name      = $faker->sentence(3);
    $slug      = $faker->slug;
    $createdAt = $faker->date() .' '. $faker->time();
    $content   = $faker->paragraphs(nb: rand(3, 15), asText: true);
    #$content   = $faker->text();

    $sql = "INSERT INTO category SET name='$name', slug='$slug'";
    $pdo->exec($sql);
    $categories[] = $pdo->lastInsertId();
    echo "[". date('d-m-Y H:i:s') . "] : $sql\n";
}
echo "Finished!\n\n";


echo "Beginning [post_category]...\n";
foreach ($posts as $post) {
    $randomCategories = $faker->randomElements($categories, rand(0, count($categories)));
    foreach ($randomCategories as $category) {
        $sql = "INSERT INTO post_category SET post_id='$post', category_id='$category'";
        $pdo->exec($sql);
        echo "[". date('d-m-Y H:i:s') . "] : $sql\n";
    }
}
echo "Finished!\n\n";


echo "Beginning [user]...\n";
$password = password_hash('admin', PASSWORD_BCRYPT);
$sql = "INSERT INTO user SET username='admin', password='$password'";
$pdo->exec($sql);
echo "[". date('d-m-Y H:i:s') . "] : $sql\n";
echo "Finished!\n\n";