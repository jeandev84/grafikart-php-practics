<?php
declare(strict_types=1);

namespace App\Controller\Auth;


use Grafikart\Controller;
use Grafikart\HTML\BootstrapForm;
use Grafikart\Http\RedirectResponse;
use Grafikart\Http\Request;
use Grafikart\Http\Response;

/**
 * Created by PhpStorm at 02.12.2023
 *
 * @LoginController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller\Auth
 */
class LoginController extends Controller
{

      public function index(Request $request): Response
      {
          $incorrect = false;

          if ($request->isMethod('POST')) {
               $username = $request->requests->get('username');
               $password = $request->requests->get('password');
               if($this->auth->attempt($username, $password)) {
                   return new RedirectResponse('/admin');
               } else {
                   $incorrect = true;
               }
          }

          $form = new BootstrapForm($request->getParsedBody());

          return $this->render('auth/login', [
              'form'      => $form,
              'incorrect' => $incorrect
          ]);
      }
}