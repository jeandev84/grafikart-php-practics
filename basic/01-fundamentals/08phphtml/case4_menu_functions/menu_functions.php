<?php

/*
<li class="nav-item <?php if ($_SERVER['SCRIPT_NAME'] === '/index.php'): ?>active<?php endif; ?>">
    <a class="nav-link" href="/index.php">Accueil</a>
</li>
*/
function nav_item(string $link, string $title) {

    $class = 'nav-item';

    if ($_SERVER['SCRIPT_NAME'] === $link) {
        $class .= " active";
    }

    // HEREDOC
    return <<<HTML
       <li class="$class">
         <a class="nav-link" href="$link">$title</a>
       </li>
HTML;


    /* return sprintf('<li class="%s"><a class="nav-link" href="%s">%s</a></li>', $class, $link, $title); */
}

?>