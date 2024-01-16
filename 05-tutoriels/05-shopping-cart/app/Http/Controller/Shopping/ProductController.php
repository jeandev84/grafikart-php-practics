<?php
declare(strict_types=1);

namespace App\Http\Controller\Shopping;

use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;

/**
 * ProductController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller\Shopping
*/
class ProductController
{
    /**
     * @param ServerRequest $request
     * @return Response
    */
    public function index(ServerRequest $request): Response
    {
        return new Response(__METHOD__);
    }



    /**
     * @param ServerRequest $request
     * @return Response
    */
    public function show(ServerRequest $request): Response
    {
        return new Response(__METHOD__);
    }
}