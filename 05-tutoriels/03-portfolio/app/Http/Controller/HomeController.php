<?php
declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\AbstractController;
use App\Repository\UserRepository;
use Grafikart\Http\Response\Response;

/**
 * HomeController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller
*/
class HomeController extends AbstractController
{
        public function index(): Response
        {
            $userRepository = new UserRepository($this->getConnection());

            dd($userRepository->findAll());

            return $this->render('index', [
                'users' => $userRepository->findAll()
            ]);
        }
}