<?php
declare(strict_types=1);

namespace App\Controller;


use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Grafikart\Controller;
use Grafikart\Http\Request;
use Grafikart\Http\Response;

/**
 * Created by PhpStorm at 02.12.2023
 *
 * @CategoryController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller
 */
class CategoryController extends Controller
{
       public function index(): Response
       {
           return  $this->render('category/index');
       }



       public function show(Request $request): Response
       {
           $categoryRepository = new CategoryRepository($this->getConnection());
           $postRepository     = new PostRepository($this->getConnection());
           $categories         = $categoryRepository->findAll();

           return  $this->render('category/show', [
               'category' => $categoryRepository->find($request->attributes->getInt('id'))
           ]);
       }
}