<?php


/**
 * @Form
*/
class Form
{


    /**
     * @var string
    */
    public static $class = 'form-control';




    /**
     * @param string $name
     * @param string $value
     * @param array $data
     * @return string
    */
    public static function checkbox(string $name, string $value = null, array $data = []): string {

        $id = strtolower($name);
        $attributes = '';

        // example isset($_GET['parfum']) && in_array('Fraise', $_GET['parfum'])
        if (isset($data[$name]) && in_array($value, $data[$name])) {
            $attributes .= 'checked';
        }

        $attributes .= ' class="'. self::$class .'"';

        return <<<HTML
     <input type="checkbox" id="$id" name="{$name}[]" value="$value" $attributes>\n
HTML;

    }




    /**
     * @param string $name
     * @param string $value
     * @param array $data
     * @return string
    */
    public static function radio(string $name, string $value, array $data = []): string {

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
     public static function select(string $name, $value, array $options): string {

        $htmlOptions = [];

        foreach ($options as $key => $option) {
            $attributes = ($key == $value) ? ' selected' : '';
            $htmlOptions[] = sprintf('<option value="%s" %s>%s</option>', $key, $attributes, $option);
        }

        return sprintf('<select class="form-control" name="%s">%s</select>', $name, implode($htmlOptions));
    }
}