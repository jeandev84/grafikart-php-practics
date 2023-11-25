<?php

function nav_item(string $link, string $title, string $linkClass = ''): string {

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


function nav_menu(string $linkClass = ''): string {
   return nav_item('/index.php', 'Accueil', $linkClass) .
          nav_item('/contact.php', 'Contact', $linkClass);
}
?>