<?php


/* ----------------------------------
 |
 |  Functions Navigation
 |
 |  ---------------------------------
*/

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
          nav_item('/contact.php', 'Contact', $linkClass);
}




/* ----------------------------------
 |
 |  Functions Formulaire
 |
 |  ---------------------------------
*/


/**
 * @param string $name
 * @param string $value
 * @param array $data
 * @return string
*/
function checkbox(string $name, string $value, array $data = []): string {

   $id = strtolower($name);
   $attributes = '';

   // example isset($_GET['parfum']) && in_array('Fraise', $_GET['parfum'])
   if (isset($data[$name]) && in_array($value, $data[$name])) {
       $attributes .= 'checked';
   }

   return <<<HTML
     <input type="checkbox" id="$id" name="{$name}[]" value="$value" $attributes>
HTML;

}


/**
 * @param string $name
 * @param string $value
 * @param array $data
 * @return string
*/
function radio(string $name, string $value, array $data = []): string {

    $id = strtolower($name);
    $attributes = '';

    // example isset($_GET['parfum']) && in_array('Fraise', $_GET['parfum'])
    if (isset($data[$name]) && $value === $data[$name]) {
        $attributes .= 'checked';
    }

    return <<<HTML
     <input type="radio" id="$id" name="$name" value="$value" $attributes>
HTML;

}


/* ----------------------------------
 |
 |  Functions deboggage
 |
 |  ---------------------------------
*/


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



function debug() {

    echo '<p style="margin-top: 20px;">';
    echo '$_GET';
    echo '<pre>';
    print_r($_GET);
    echo '<pre>';
    echo '</p>';

    echo "<p>";
    echo '$_POST';
    echo '<pre>';
    print_r($_POST);
    echo '<pre>';
    echo '</p>';
}


/**
 * @param string $str
 * @return string
*/
function escape(string $str): string
{
    return htmlentities($str, ENT_QUOTES, 'UTF-8');
}


?>