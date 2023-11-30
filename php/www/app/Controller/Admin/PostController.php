<?php
declare(strict_types=1);

namespace App\Controller\Admin;


use Grafikart\AbstractController;

/**
 * Created by PhpStorm at 30.11.2023
 *
 * @PostController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller\Admin
 */
class PostController extends AbstractController
{

       public function index()
       {
           return $this->render('admin/post/index', [

           ]);
       }
}