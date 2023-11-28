<?php
declare(strict_types=1);

namespace App\Validators;


use App\Repository\PostRepository;
use Grafikart\Service\JanValidator;

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
    protected JanValidator $validator;

    public function __construct(array $data, string $lang = 'fr')
    {
        JanValidator::lang($lang);
        $this->data = $data;
        $this->validator = new JanValidator($data);
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