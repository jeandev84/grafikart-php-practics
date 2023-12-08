<?php
declare(strict_types=1);

namespace Tests\Account\Actions;


use App\Account\Actions\SignupAction;
use App\Auth\Repository\UserRepository;
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



       protected function setUp()
       {
           $this->userRepository = $this->prophesize(UserRepository::class);
           $pdo = $this->prophesize(\PDO::class);
           $statement = $this->getMockBuilder(\PDOStatement::class)->getMock();
           $statement->expects($this->any())->method('fetchColumn')->willReturn(false);
           $pdo->prepare(Argument::any())->willReturn($statement);
           $this->userRepository->getPdo()->willReturn('fake');
           $this->userRepository->getPdo()->willReturn($pdo->reveal());

           $this->renderer = $this->prophesize(RendererInterface::class);
           $this->renderer->render(Argument::any(), Argument::any())->willReturn('');
           $this->action = new SignupAction(
               $this->renderer->reveal(),
               $this->userRepository->reveal()
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
}