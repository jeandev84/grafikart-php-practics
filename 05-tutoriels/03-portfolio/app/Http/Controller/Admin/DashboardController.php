<?php
declare(strict_types=1);

namespace App\Http\Controller\Admin;

use App\Http\AbstractController;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;

/**
 * DashboardController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller\Admin
 */
class DashboardController extends AbstractController
{
       public function index(ServerRequest $request): Response
       {
           return $this->render('admin/dashboard');
       }
}