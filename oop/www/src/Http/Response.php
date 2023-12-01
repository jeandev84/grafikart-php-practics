<?php
declare(strict_types=1);

namespace Grafikart\Http;


/**
 * Created by PhpStorm at 01.12.2023
 *
 * @Response
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http
 */
class Response
{
   public function __construct(
       protected ?string $body,
       protected int $status = 200,
       protected array $headers = []
   )
   {
   }


    /**
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }




    /**
     * @param string $body
     *
     * @return $this
    */
    public function withBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }






    /**
     * @return array
    */
    public function getHeaders(): array
    {
        return $this->headers;
    }




    /**
     * @param string $name
     * @param $value
     * @return $this
    */
    public function withHeader(string $name, $value): self
    {
        $this->headers[$name] = $value;

        return $this;
    }





    /**
     * @return int
    */
    public function getStatus(): int
    {
        return $this->status;
    }




    /**
     * @param int $status
     *
     * @return $this
    */
    public function withStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }



    public function send(): void
    {
         if (! headers_sent()) {
             return;
         }
         $this->sendHeaders();
    }


    public function sendBody(): void
    {
         echo $this->body;
    }


    private function sendHeaders(): mixed
    {
        ob_start();
        http_response_code($this->status);
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
        return ob_get_flush();
    }



    public function __toString(): string
    {
        return $this->getBody();
    }
}