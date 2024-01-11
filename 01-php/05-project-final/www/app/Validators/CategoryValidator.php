<?php
declare(strict_types=1);

namespace App\Validators;


use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Grafikart\Service\Validator;

/**
 * Created by PhpStorm at 28.11.2023
 *
 * @PostValidator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Validators
 */
class CategoryValidator extends AbstractValidator
{

    protected array $data;
    protected Validator $validator;

    public function __construct(array $data, CategoryRepository $categoryRepository, ?int $categoryId = null)
    {
        parent::__construct($data);
        $this->validator->rule('required', ['name', 'slug']);
        $this->validator->rule('lengthBetween', ['name', 'slug'], 3, 200);
        $this->validator->rule('slug', 'slug');
        $this->validator->rule(function ($field, $value) use ($categoryRepository, $categoryId) {
             return !$categoryRepository->exists($field, $value, $categoryId);
        }, ['slug', 'name'], "Ce valeur est deja utilise");
    }
}