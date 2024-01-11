<?php
declare(strict_types=1);

namespace Framework\Http\Response;


use GuzzleHttp\Psr7\Response;

/**
 * Created by PhpStorm at 08.12.2023
 *
 * @RedirectResponse
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Http\Response
 */
class RedirectResponse extends Response
{

       /**
        * @param string $url
       */
       public function __construct(string $url)
       {
           parent::__construct(301, ['Location' => $url]);
       }
}