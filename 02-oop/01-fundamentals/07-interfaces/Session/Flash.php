<?php
declare(strict_types=1);

namespace Grafikart\Http\Session;


/**
 * Created by PhpStorm at 02.12.2023
 *
 * @Flash
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http\Session
 */
class Flash
{

     protected SessionInterface $session;
     private string $flashKey = 'flash.message';


     public function __construct(Session $session)
     {
         $this->session = $session;
     }


     public function set($message, $type = 'success')
     {
         $this->session->set($this->flashKey, [
             'message' => $message,
             'type' => $type
         ]);
     }



     public function get($type)
     {
         $flash = $this->session->get($this->flashKey);

         $this->session->delete($this->flashKey);

         return "<div class='alert alert-{$flash['type']}'>{$flash['message']}</div>";
     }
}