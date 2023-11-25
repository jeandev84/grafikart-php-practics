<h1>Ma  homepage</h1>

<a href="<?= $router->generate('contact')?>">Nous contacter</a>
<a href="<?= $router->generate('article', ['id' => 60, 'slug' => "something-like-slug"])?>">Voir l' article</a>


<?php ob_start(); ?>
   <script>alert('Salut')</script>
<?php $pageJavascript = ob_get_clean(); ?>
