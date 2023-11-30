<?php
declare(strict_types=1);

namespace App\Controller\Blog;


use Grafikart\AbstractController;

/**
 * Created by PhpStorm at 30.11.2023
 *
 * @CategoryController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller\Blog
 */
class CategoryController extends AbstractController
{

     public function show()
     {
         return $this->render('category/show', [
             'category' => ''
         ]);
     }
}