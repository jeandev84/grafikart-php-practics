<?php
declare(strict_types=1);

namespace App\Http\Controller\Admin;

use App\Http\Controller\AdminController;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;

/**
 * CategoryController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller\Admin
 */
class CategoryController extends AdminController
{
      public function index(ServerRequest $request): Response
      {
          return $this->render('admin/category/index', [
              'categories' => ''
          ]);
      }
}