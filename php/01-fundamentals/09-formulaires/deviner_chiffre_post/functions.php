<?php


/**
 * @param string $link
 * @param string $title
 * @param string $linkClass
 * @return string
*/
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


/**
 * @param string $linkClass
 * @return string
*/
function nav_menu(string $linkClass = ''): string {
   return nav_item('/index.php', 'Accueil', $linkClass) .
          nav_item('/Contact.php', 'Contact', $linkClass);
}


/**
 * @param $str
 * @return string
*/
function escape($str) {
    return htmlentities($str, ENT_QUOTES, 'UTF-8');
}



/**
 * @param $data
 * @param bool $die
 * @return void
*/
function dump($data, bool $die = false) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    if ($die) die;
}
?>