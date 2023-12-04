<?php //require_once 'menu_functions.php'; ?>
<?php

/*
<li class="nav-item <?php if ($_SERVER['SCRIPT_NAME'] === '/index.php'): ?>active<?php endif; ?>">
    <a class="nav-link" href="/index.php">Accueil</a>
</li>
*/

if (! function_exists('nav_item')) {
    function nav_item(string $link, string $title, string $linkClass = '') {

        $navClass = 'nav-item';

        if ($_SERVER['SCRIPT_NAME'] === $link) {
            $navClass .= " active";
        }

        // HEREDOC
        return <<<HTML
       <li class="$navClass">
         <a class="$linkClass" href="$link">$title</a>
       </li>
HTML;


        /* return sprintf('<li class="%s"><a class="nav-link" href="%s">%s</a></li>', $class, $link, $title); */
    }

}
?>

<?= nav_item('/index.php', 'Accueil', $linkClass) ?>
<?= nav_item('/Contact.php', 'Contact', $linkClass) ?>