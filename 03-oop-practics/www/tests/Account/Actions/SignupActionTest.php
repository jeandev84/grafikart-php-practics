<?php
declare(strict_types=1);

namespace Tests\Account\Actions;


use App\Account\Actions\SignupAction;
use App\Auth\Entity\User;
use App\Auth\Repository\UserRepository;
use App\Auth\Security\DatabaseAuth;
use Framework\Routing\Router;
use Framework\Security\Auth;
use Framework\Session\FlashService;
use Framework\Templating\Renderer\RendererInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Tests\ActionTestCase;

/**
 * Created by PhpStorm at 08.12.2023
 *
 * @SignupActionTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Account\Actions
 */
class SignupActionTest extends ActionTestCase
{

       /**
        * @var SignupAction
       */
       protected $action;


       /**
        * @var RendererInterface|\Prophecy\Prophecy\ObjectProphecy
       */
       protected $renderer;


       /**
        * @var UserRepository|\Prophecy\Prophecy\ObjectProphecy
       */
       protected $userRepository;


       /**
        * @var Router|\Prophecy\Prophecy\ObjectProphecy
       */
       protected $router;



       /**
        * @var Auth|\Prophecy\Prophecy\ObjectProphecy
       */
       protected $auth;


        /**
         * @var FlashService|\Prophecy\Prophecy\ObjectProphecy
        */
       protected $flashService;

       protected function setUp()
       {
           // UserRepository
           $this->userRepository = $this->prophesize(UserRepository::class);
           $pdo = $this->prophesize(\PDO::class);
           $statement = $this->getMockBuilder(\PDOStatement::class)->getMock();
           $statement->expects($this->any())->method('fetchColumn')->willReturn(false);
           $pdo->prepare(Argument::any())->willReturn($statement);
            $pdo->lastInsertId()->willReturn(3);
           $this->userRepository->getPdo()->willReturn('fake');
           $this->userRepository->getPdo()->willReturn($pdo->reveal());

           // Renderer
           $this->renderer = $this->prophesize(RendererInterface::class);
           $this->renderer->render(Argument::any(), Argument::any())->willReturn('');

           // Flash
           $this->flashService = $this->prophesize(FlashService::class);

           // Router
           $this->router = $this->prophesize(Router::class);
           $this->router->generateUri(Argument::any(), Argument::any())->willReturn('');

           // Auth
           $this->auth = $this->prophesize(DatabaseAuth::class);

           $this->action = new SignupAction(
               $this->renderer->reveal(),
               $this->userRepository->reveal(),
               $this->router->reveal(),
               $this->auth->reveal(),
               $this->flashService->reveal()
           );
       }



       public function testGet()
       {
            call_user_func($this->action, $this->makeRequest());
            $this->renderer->render('@account/signup')->shouldHaveBeenCalled();
       }




       public function testPostInvalid()
       {
           call_user_func($this->action, $this->makeRequest('/demo', [
               'username'  => 'John Doe',
               'email'     => 'azeaze',
               'password'  => '0000',
               'password_confirm' => '000'
           ]));
           $this->renderer->render('@account/signup', Argument::that(function ($params) {
                 $this->assertArrayHasKey('errors', $params);
                 $this->assertEquals(['email', 'password'], array_keys($params['errors']));
                 return true;
           }))->shouldHaveBeenCalled();
       }



    public function testPostValid()
    {
        $this->userRepository->insert(Argument::that(function (array $userParams) {
            $this->assertArraySubset([
                'username' => 'John Doe',
                'email' => 'john@doe.fr'
            ]);
            $this->assertTrue(password_verify('0000', $userParams['password']));
            return true;
        }))->shouldBeCalled();

        $this->auth->setUser(Argument::that(function (User $user) {
             $this->assertEquals('John Doe', $user->username);
             $this->assertEquals('john@doe.fr', $user->email);
             $this->assertEquals(3, $user->id);
             return true;
        }))->shouldBeCalled();

        $this->renderer->render()->shouldNotBeCalled();
        $this->flashService->success(Argument::type('string'))->shouldBeCalled();
        $response = call_user_func($this->action, $this->makeRequest('/demo', [
            'username'  => 'John Doe',
            'email'     => 'john@doe.fr',
            'password'  => '0000',
            'password_confirm' => '0000'
        ]));
        $this->assertRedirect($response, 'auth.login');
    }




    public function testPostWithNoPassword()
    {
        call_user_func($this->action, $this->makeRequest('/demo', [
            'username'  => 'John Doe',
            'email'     => 'azeaze',
            'password'  => '',
            'password_confirm' => ''
        ]));
        $this->renderer->render('@account/signup', Argument::that(function ($params) {
            $this->assertArrayHasKey('errors', $params);
            $this->assertEquals(['email', 'password'], array_keys($params['errors']));
            return true;
        }))->shouldHaveBeenCalled();
    }
}