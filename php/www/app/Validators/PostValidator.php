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
class PostValidator extends AbstractValidator
{

    protected array $data;
    protected JanValidator $validator;

    public function __construct(array $data, PostRepository $postRepository, ?int $postId = null)
    {
        parent::__construct($data);
        $this->validator->rule('required', ['name', 'slug']);
        $this->validator->rule('lengthBetween', ['name', 'slug'], 3, 200);
        $this->validator->rule('slug', 'slug');
        $this->validator->rule(function ($field, $value) use ($postRepository, $postId) {
             return !$postRepository->exists($field, $value, $postId);
        }, ['slug', 'name'], "Ce valeur est deja utilise");
    }
}