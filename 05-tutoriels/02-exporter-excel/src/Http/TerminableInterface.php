<?php
declare(strict_types=1);

namespace Grafikart\Http;


use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;

/**
 * TerminableInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Http
 */
interface TerminableInterface
{

     /**
      * @param ServerRequest $request
      * @param Response $response
      * @return void
     */
     public function terminate(ServerRequest $request, Response $response): void;
}