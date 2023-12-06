<?php
declare(strict_types=1);

namespace App\Blog\Actions;


use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 06.12.2023
 *
 * @CategoryShowAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Blog\Actions
 */
class CategoryShowAction
{

     public function __invoke(ServerRequestInterface $request)
     {
          return '';
     }
}