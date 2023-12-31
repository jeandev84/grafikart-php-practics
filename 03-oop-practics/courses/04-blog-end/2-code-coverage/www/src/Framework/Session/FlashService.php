<?php
declare(strict_types=1);

namespace Framework\Session;


/**
 * Created by PhpStorm at 05.12.2023
 *
 * @FlashService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Session
 */
class FlashService
{

     /**
      * @var SessionInterface
     */
     protected SessionInterface $session;


     /**
      * @var string
     */
     protected string $sessionKey = 'flash';


     protected $messages;


     public function __construct(SessionInterface $session)
     {
         $this->session = $session;
     }




     /**
      * @param string $type
      *
      * @param string $message
      * @return $this
     */
     public function addFlash(string $type, string $message): self
     {
         $flash = $this->session->get($this->sessionKey, []);
         $flash[$type] = $message;
         $this->session->set($this->sessionKey, $flash);

         return $this;
     }




     /**
      * @param string $message
      * @return void
     */
     public function success(string $message): void
     {
          $this->addFlash('success', $message);
     }



    /**
     * @param string $message
     * @return void
     */
    public function error(string $message): void
    {
        $this->addFlash('error', $message);
    }




     /**
      * @param string $type
      *
      * @return string|null
     */
     public function get(string $type): ?string
     {
         if (is_null($this->messages)) {
             $this->messages = $this->session->get($this->sessionKey, []);
             $this->session->delete($this->sessionKey);
         }

         return $this->messages[$type] ?? null;
     }



     public function getFlashes(): mixed
     {
         return $this->session->get($this->sessionKey, []);
     }




     /**
      * @param string $type
      *
      * @return bool
     */
     public function hasFlash(string $type): bool
     {
         return array_key_exists($type, $this->getFlashes());
     }
}