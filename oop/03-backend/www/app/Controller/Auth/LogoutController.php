<?php
declare(strict_types=1);

namespace App\Controller\Auth;


use Grafikart\Controller;
use Grafikart\Http\RedirectResponse;

/**
 * Created by PhpStorm at 02.12.2023
 *
 * @LogoutController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller\Auth
 */
class LogoutController extends Controller
{

     public function index(): RedirectResponse
     {
           $this->auth->logout();

           return $this->redirectToRoute("auth.login");
     }
}