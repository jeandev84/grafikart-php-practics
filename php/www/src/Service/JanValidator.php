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