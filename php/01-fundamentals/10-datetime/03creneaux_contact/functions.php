<?php


/* ----------------------------------
 |
 |  NAVIGATION LINK
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
          nav_item('/Contact.php', 'Contact', $linkClass);
}




/* ----------------------------------
 |
 |  FORM INPUT
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


/**
 * @param string $name
 * @param $value
 * @param array $options
 * @return void
*/
function select(string $name, $value, array $options): string {

     $htmlOptions = [];

     foreach ($options as $key => $option) {
         $attributes = ($key == $value) ? ' selected' : '';
         $htmlOptions[] = sprintf('<option value="%s" %s>%s</option>', $key, $attributes, $option);
     }

     return sprintf('<select class="form-control" name="%s">%s</select>', $name, implode($htmlOptions));
}


/*
<select name="jour" id="days" class="form-control">
    <?php foreach (JOURS as $key => $day): ?>
        <option value="<?= $key ?>">
            <?= $day ?>
        </option>
    <?php endforeach; ?>
</select>
*/


/* ----------------------------------
 |
 |  CRENEAUX
 |
 |  ---------------------------------
*/


/**
 * @param array $creneaux
 * @return string
*/
function creneauxHtml(array $creneaux): string
{

    if (empty($creneaux)) { // if(count($creneaux) === 0) { return "Ferme"; }
        return "Ferme";
    }

    // Construire le tableau intermediaire de Xh a Yh
    // Implode pour construire la phrase finale

    $phrases = [];

    foreach ($creneaux as $creneau) {
        $phrases[] = "de <strong>{$creneau[0]}h</strong> a <strong>{$creneau[1]}h</strong>";
    }

    return 'Ouvert '. implode(' et ', $phrases);
}




function in_creneaux(int $heure, array $creneaux): bool {

    foreach ($creneaux as $creneau) {
         $debut = $creneau[0];
         $fin   = $creneau[1];

         if ($heure >= $debut && $heure < $fin) {
             return true;
         }
    }

    return false;
}


/* ----------------------------------
 |
 |  DEBUG
 |
 |  ---------------------------------
*/


/**
 * @param $data
 * @param bool $die
 * @return void
*/
function dump($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}


function dd($data, bool $die = false) {
    dump($data);
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