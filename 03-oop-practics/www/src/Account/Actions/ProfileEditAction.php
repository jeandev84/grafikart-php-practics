<?php
declare(strict_types=1);

namespace App\Account\Actions;


use App\Auth\Repository\UserRepository;
use Framework\Http\Response\RedirectResponse;
use Framework\Security\Auth;
use Framework\Security\Hash\PasswordHash;
use Framework\Session\FlashService;
use Framework\Templating\Renderer\RendererInterface;
use Framework\Validation\Validator;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 09.12.2023
 *
 * @ProfileEditAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Account\Actions
 */
class ProfileEditAction
{
    /**
     * @var RendererInterface
     */
    protected RendererInterface $renderer;



    /**
     * @var Auth
     */
    protected Auth $auth;


    /**
     * @var FlashService
     */
    protected FlashService $flashService;



    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;



    public function __construct(
        RendererInterface $renderer,
        Auth $auth,
        FlashService $flashService,
        UserRepository $userRepository
    )
    {
        $this->renderer = $renderer;
        $this->auth     = $auth;
        $this->flashService = $flashService;
        $this->userRepository = $userRepository;
    }



    public function __invoke(ServerRequestInterface $request): mixed
    {
        $user   = $this->auth->getUser();
        $params = $request->getParsedBody();

        $validator = (new Validator($params))
                     ->confirm('password')
                     ->required('firstname', 'lastname');

        if ($validator->isValid()) {

            $userParams = [
                'firstname' => $params['firstname'],
                'lastname'  => $params['lastname']
            ];

            if (!empty($params['password'])) {
                $userParams['password'] = PasswordHash::hash($params['password']);
            }

            $this->userRepository->update($userParams, $user->id);
            $this->flashService->success("Votre compte a bien ete mis a jour");
            return new RedirectResponse($request->getUri()->getPath());
        }

        return $this->renderer->render('@account/profile', [
            'user'   => $user,
            'errors' => $validator->getErrors()
        ]);
    }
}