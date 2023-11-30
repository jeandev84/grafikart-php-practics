<?php
declare(strict_types=1);

namespace App\Controller\Auth;


use Grafikart\AbstractController;
use Grafikart\Http\Response\RedirectResponse;
use Grafikart\Http\Response\Response;

/**
 * Created by PhpStorm at 30.11.2023
 *
 * @LogoutController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller\Auth
 */
class LogoutController extends AbstractController
{

       public function logout(): RedirectResponse
       {
            session_destroy();
            return $this->redirectToRoute('login');
       }
}