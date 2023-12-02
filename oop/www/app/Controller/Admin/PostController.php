<?php
declare(strict_types=1);

namespace App\Controller\Admin;


use Grafikart\Container\Container;
use Grafikart\Controller;
use Grafikart\Http\Response;


/**
 * Created by PhpStorm at 02.12.2023
 *
 * @PostController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller\Admin
 */
class PostController extends Controller
{


     public function index(): Response
     {
          if (! $this->auth->logged()) {
              return $this->forbidden();
          }

          return $this->render('admin/posts/index');
     }
}