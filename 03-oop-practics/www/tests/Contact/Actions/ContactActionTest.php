<?php
declare(strict_types=1);

namespace Tests\Contact\Actions;

use App\Contact\Actions\ContactAction;
use Framework\Http\Response\RedirectResponse;
use Framework\Session\FlashService;
use Framework\Templating\Renderer\RendererInterface;
use PHPUnit\Framework\TestCase;
use Tests\ActionTestCase;

/**
 * Created by PhpStorm at 08.12.2023
 *
 * @ContactActionTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Contact\Actions
 */
class ContactActionTest extends ActionTestCase
{

     /**
      * @var RendererInterface
     */
     protected $renderer;


     /**
      * @var ContactAction
     */
     protected $action;



     /**
      * @var FlashService
     */
     protected $flash;


     /**
      * @var \Swift_Mailer
     */
     protected $mailer;


     /**
      * @var string
     */
     protected string $to = 'contact@demo.fr';


     public function setUp()
     {
         $this->renderer = $this->getMockBuilder(RendererInterface::class)->getMock();
         $this->flash    = $this->getMockBuilder(FlashService::class)->getMock();
         $this->mailer   = $this->getMockBuilder(\Swift_Mailer::class)->getMock();
         $this->action   = new ContactAction($this->to, $this->renderer, $this->flash, $this->mailer);
     }


     public function testGet()
     {
         $this->renderer->expects($this->once())
                        ->method('render')
                        ->with('@contact/contact')
                        ->willReturn('');

         call_user_func($this->action, $this->makeRequest('/contact'));
     }



     public function testPostInvalid()
     {
          $request = $this->makeRequest('/contact', [
             'name'   => 'Jean marc',
             'email'  => 'azezae',
             'content' => 'azeazeazeazeazeazeaze'
          ]);

          $this->renderer
               ->expects($this->once())
               ->method('render')
               ->with(
       '@contact/contact',
                  $this->callback(function ($params) {
                      $this->assertArrayHasKey('errors', $params);
                      $this->assertArrayHasKey('email', $params['errors']);
                      return true;
                  })
               )
               ->willReturn('');

          $this->flash->expects($this->once())->method('error');
          call_user_func($this->action, $request);
     }





     public function testPostValid()
     {
         $request = $this->makeRequest('/contact', [
             'name'   => 'Jean marc',
             'email'  => 'demo@local.dev',
             'content' => 'azeazeazeazeazeazeaze'
         ]);

         $this->flash->expects($this->once())->method('success');
         $this->mailer
              ->expects($this->once())
              ->method('send')
              ->with($this->callback(function (\Swift_Message $message) {
                   $this->assertEquals($this->to, $message->getTo());
                   $this->assertEquals('demo@local.dev', $message->getFrom());
              }));

         $response = call_user_func($this->action, $request);
         $this->assertInstanceOf(RedirectResponse::class, $response);
     }
}