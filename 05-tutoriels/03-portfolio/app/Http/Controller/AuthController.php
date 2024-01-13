<?php
declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\AbstractController;
use Grafikart\Container\Container;
use Grafikart\HTML\Form\Form;
use Grafikart\Http\Parameter;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\RedirectResponse;
use Grafikart\Http\Response\Response;
use Grafikart\Security\Auth;

/**
 * AuthController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller
 */
class AuthController extends AbstractController
{

     public function login(ServerRequest $request): Response
     {
         $form     = new Form($request->getParsedBody());
         $username = $form->get('username', '');
         $password = $form->get('password', '');

         if($this->auth->attempt($username, $password)) {
             /* dd($this->auth->getUser()); */
              $this->addFlash('success', "Vous etes maintenant connecte.");
              return $this->redirectTo('/admin');
         }

         return $this->render('auth/login', [
             'form' => $form
         ]);
     }





     /**
      * @return RedirectResponse
     */
     public function logout(): RedirectResponse
     {
         $this->auth->logout();

         return $this->redirectTo('/login');
     }
}