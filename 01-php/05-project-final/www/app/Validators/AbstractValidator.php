<?php
declare(strict_types=1);

namespace App\Validators;


use App\Repository\PostRepository;
use Grafikart\Service\Validator;

/**
 * Created by PhpStorm at 28.11.2023
 *
 * @AbstractValidator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Validators
 */
abstract class AbstractValidator
{

    protected array $data;
    protected Validator $validator;

    public function __construct(array $data, string $lang = 'fr')
    {
        Validator::lang($lang);
        $this->data = $data;
        $this->validator = new Validator($data);
    }



    public function getRules()
    {
        return [];
    }


    public function validate(): bool
    {
        return $this->validator->validate();
    }



    public function errors(): array
    {
        return $this->validator->errors();
    }

}