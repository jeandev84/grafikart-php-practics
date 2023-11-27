<?php
declare(strict_types=1);

namespace App;

use Grafikart\Http\Contract\Terminable;
use Grafikart\Http\HttpKernel;
use Grafikart\Http\Request\Request;
use Grafikart\Http\Response\Response;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @Kernel
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App
 */
class Kernel extends HttpKernel implements Terminable
{


    public function __construct(bool $debug = false)
    {
    }



    public function handle(Request $request): Response
    {
        try {

        } catch (\Exception $exception) {

        }
    }



    public function terminate(Request $request, Response $response)
    {

    }

    public function getProjectDir(): string
    {
         return dirname(__DIR__);
    }
}


/*
// Kernel
$kernel = new \App\Kernel();
$response = $kernel->handle(
    $request = \Grafikart\Http\Request\Request::createFromGlobals()
);

$response->send();
*/