<?php
declare(strict_types=1);

namespace Framework\Mailer;


/**
 * Created by PhpStorm at 08.12.2023
 *
 * @SendMessage
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Mailer
 */
class SendMessage implements MessageInterface
{
    protected array $body = [];
    protected array $to = [];
    protected array $form = [];


    /**
     * @param string $body
     *
     * @return $this
   */
    public function body(string $body): static
    {
        $this->body[] = $body;

        return $this;
    }



    public function to(string $to): static
    {
         $this->to[] = $to;

         return  $this;
    }



    public function from(string $from): static
    {
         $this->form[] = $from;

         return $this;
    }


    public function getBody(): mixed
    {
        return join(PHP_EOL, $this->body);
    }



    public function getFrom(): mixed
    {
        return join(', ', $this->form);
    }


    public function getTo(): mixed
    {
        return join(', ', $this->to);
    }
}