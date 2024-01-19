<?php
declare(strict_types=1);

namespace Grafikart\Security\Token\Csrf;


/**
 * CsrfTokenInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Security\Token\Csrf
 */
interface CsrfTokenInterface
{

       /**
        * Generate Token CSRF
        *
        * @return string
       */
       public function generateToken(): string;





       /**
        * @return bool
       */
       public function hasToken(): bool;




       /**
        * @param string $token
        *
        * @return bool
       */
       public function isValidToken(string $token): bool;




       /**
        * @return string
       */
       public function getToken(): string;
}