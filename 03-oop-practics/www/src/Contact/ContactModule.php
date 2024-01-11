<?php
declare(strict_types=1);

namespace App\Contact;


use App\Contact\Actions\ContactAction;
use Framework\Module;
use Framework\Routing\Router;
use Framework\Templating\Renderer\RendererInterface;

/**
 * Created by PhpStorm at 08.12.2023
 *
 * @ContactModule
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Contact
 */
class ContactModule extends Module
{

       const DEFINITIONS = __DIR__ . '/definitions.php';


      public function __construct(Router $router, RendererInterface $renderer)
      {
          $renderer->addPath('contact', __DIR__);
          $router->map('GET|POST', '/contact', ContactAction::class, 'contact');
      }
}