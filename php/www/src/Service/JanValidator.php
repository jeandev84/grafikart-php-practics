<?php
declare(strict_types=1);

namespace Grafikart\Service;
use Valitron\Validator;


/**
 * Created by PhpStorm at 28.11.2023
 *
 * @JanValidator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Service
 */
class JanValidator extends Validator
{

    public function __construct(array $data, $lang = null)
    {
        parent::__construct($data, [], $lang);
        self::addRule('image', function ($field, $value, array $params, array $fields) {
            if ($value['size'] === 0) {
                return true;
            }
            $mimes    = ['image/jpeg', 'image/png'];
            $info     = new \finfo();
            $mimeType = $info->file($value['tmp_name'], FILEINFO_MIME_TYPE); // image/jpeg ... return mime type
            return in_array($mimeType, $mimes);
        }, "Le fichier n'est pas une image valide");
    }



    /**
     * @param  string $field
     * @param  string $message
     * @param  array  $params
     * @return array
     */
    protected function checkAndSetLabel($field, $message, $params)
    {
        return str_replace('{field} ', '', $message);
    }
}