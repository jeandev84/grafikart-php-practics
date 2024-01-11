<?php
declare(strict_types=1);
namespace App\Controller\Auth;


use Exception;
use Grafikart\AbstractController;
use Grafikart\Http\Request\Request;
use Grafikart\Http\Response\Response;

/**
 * Created by PhpStorm at 30.11.2023
 *
 * @LoginController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller\Auth
 */
class LoginController extends AbstractController
{

      public function login(Request $request): Response
      {
          $user = new \App\Entity\User();
          $errors = [];

          if ($request->isMethod('POST')) {

              try {

                  $username = $request->request->get('username');
                  $password = $request->request->get('password');
                  $user->setUsername($username);
                  $errors['password'] = "Identifiant ou mot de passe incorrect";

                  if (! $username || !$password) {
                      throw new Exception("Identifiant ou mot de passe incorrect");
                  }

                  $connection = \App\Helpers\Connection::make();
                  $repository = new \App\Repository\UserRepository($connection);
                  $u = $repository->findByUsername($username);
                  $hashedPassword = $u->getPassword();

                  if(password_verify($password, $hashedPassword)) {
                      $_SESSION['auth'] = $u->getId();
                      return $this->redirectToRoute('admin.posts');
                  }

              } catch (Exception $exception) {
                  $errors['password'] = "Identifiant ou mot de passe incorrect";
               }
            }

            $form = new \Grafikart\HTML\Form($user, $errors);

            return $this->render('auth/login', [
                'form' => $form,
                'errors' => $errors,
                'forbidden' => $request->queries->has('forbidden')
            ]);
      }
}