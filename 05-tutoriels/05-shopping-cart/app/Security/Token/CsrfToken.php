<?php
declare(strict_types=1);

namespace App\Security\Token;

use Grafikart\Http\Session\SessionInterface;
use Grafikart\Security\Token\Csrf\CsrfTokenInterface;

/**
 * CsrfToken
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Security\Token
 */
class CsrfToken implements CsrfTokenInterface
{

    CONST KEY = 'csrf.token';

    protected SessionInterface $session;


    /**
     * @param SessionInterface $session
    */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }


    /**
     * @return string
    */
    public function generateToken(): string
    {
        if (!$this->hasToken()) {
            $token = md5(time() . rand());
            $this->session->set(self::KEY, $token);
        }

        return $this->session->get(self::KEY);
    }



    /**
     * @inheritDoc
    */
    public function hasToken(): bool
    {
       return $this->session->has(self::KEY);
    }



    /**
     * @inheritDoc
    */
    public function isValidToken(string $token): bool
    {
        if(!$tokenSession = $this->getToken()) {
            return false;
        }

        return ($token === $tokenSession);
    }



    /**
     * @inheritDoc
    */
    public function getToken(): string
    {
        return $this->session->get(self::KEY, '');
    }
}