<?php
declare(strict_types=1);

namespace Framework\Middleware;


use Framework\Exception\CsrfInvalidException;
use Framework\Session\SessionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Created by PhpStorm at 06.12.2023
 *
 * @CsrfMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Middleware
 */
class CsrfMiddleware implements MiddlewareInterface
{


    /**
     * @var string
    */
    protected string $formKey;


    /**
     * @var string
    */
    protected string $sessionKey;


    /**
     * @var int
    */
    protected int $maxLimitTokens = 50;


    /**
     * @var mixed
    */
    protected $session;


    /**
     * @param array $session
     *
     * @param int $maxLimitTokens
     *
     * @param string $formKey
     *
     * @param string $sessionKey
    */
    public function __construct(
        &$session,
        int $maxLimitTokens = 50,
        string $formKey = '_csrf',
        string $sessionKey = 'csrf'
    )
    {
        $this->validSession($session);
        $this->session    = &$session;
        $this->maxLimitTokens = $maxLimitTokens;
        $this->formKey    = $formKey;
        $this->sessionKey = $sessionKey;
    }






    /**
     * @inheritDoc
    */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
         if ($this->matchInMethod($request->getMethod())) {
              $parsedBody = $request->getParsedBody() ?: [];
              if (! $this->hasParsedCsrfToken($parsedBody)) {
                   $this->reject();
              } else {
                  $token = $parsedBody[$this->formKey];
                  if ($this->hasCsrfTokenInList($token)) {
                      $this->useToken($token);
                      return $handler->handle($request);
                  } else {
                      $this->reject();
                  }
              }
         } else {
              return $handler->handle($request);
         }
    }



    public function generateToken(): string
    {
         $token      = bin2hex(random_bytes(16));
         $tokens     = $this->session[$this->sessionKey] ?? [];
         $tokens[]   = $token;
         $this->session[$this->sessionKey] = $tokens;
         $this->limitTokens();
         return $token;
    }



    /**
     * @return string
    */
    public function getFormKey(): string
    {
        return $this->formKey;
    }




    /**
     * @return string
    */
    public function getSessionKey(): string
    {
        return $this->sessionKey;
    }




    private function limitTokens(): void
    {
        $tokens = $this->session[$this->sessionKey] ?? [];

        if (count($tokens) > $this->maxLimitTokens) {
             array_shift($tokens);
        }

        $this->session[$this->sessionKey] = $tokens;
    }





    /**
     * @param $token
     * @return void
    */
    private function useToken($token): void
    {
        $tokens = array_filter($this->session[$this->sessionKey], function ($tokenParam) use ($token) {
                         return $token !== $tokenParam;
                 });

        $this->session[$this->sessionKey] = $tokens;
    }




    /**
     * @param string $csrfToken
     *
     * @return bool
    */
    private function hasCsrfTokenInList(string $csrfToken): bool
    {
        $csrfList = $this->session[$this->sessionKey] ?? [];

        return in_array($csrfToken, $csrfList);
    }





    /**
     * @param array $parsedBody
     *
     * @return bool
    */
    private function hasParsedCsrfToken(array $parsedBody): bool
    {
        return array_key_exists($this->formKey, $parsedBody);
    }




    /**
     * @return array
    */
    private function getTokens(): array
    {
        return $this->session[$this->sessionKey] ?? [];
    }




    /**
     * @param string $method
     *
     * @return bool
    */
    private function matchInMethod(string $method): bool
    {
        return in_array($method, ['POST', 'PUT', 'DELETE']);
    }



    private function validSession($session)
    {
        if (!is_array($session) && !$session instanceof \ArrayAccess) {
             throw new \TypeError("La session passee au middleware CSRF n' est pas tratable comme un tableau");
        }
    }


    private function reject(): void
    {
         throw new CsrfInvalidException();
    }

}