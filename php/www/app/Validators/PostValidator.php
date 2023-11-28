<?php
declare(strict_types=1);

namespace App\Validators;


use App\Repository\PostRepository;
use Grafikart\Service\JanValidator;

/**
 * Created by PhpStorm at 28.11.2023
 *
 * @PostValidator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Validators
 */
class PostValidator
{

    protected array $data;
    protected JanValidator $validator;

    public function __construct(array $data, PostRepository $postRepository)
    {
        $this->data = $data;
        $v = new JanValidator($data);
        $v->rule('required', ['name', 'slug']);
        $v->rule('lengthBetween', ['name', 'slug'], 3, 200);
        $v->rule('slug', 'slug');
        $v->rule(function ($field, $value) use ($postRepository) {
             return !$postRepository->exists($field, $value);
        }, 'slug', "Ce slug est deja utilise");
        $this->validator = $v;
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