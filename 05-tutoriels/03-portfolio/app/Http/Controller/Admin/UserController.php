<?php
declare(strict_types=1);

namespace App\Http\Controller\Admin;

use App\Http\Controller\AdminController;
use App\Repository\UserRepository;
use Grafikart\Http\Response\Response;

/**
 * UserController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller\Admin
 */
class UserController extends AdminController
{
    public function index(): Response
    {
        $userRepository = new UserRepository($this->getConnection());

        return $this->render('index', [
            'users' => $userRepository->findAll()
        ]);
    }
}