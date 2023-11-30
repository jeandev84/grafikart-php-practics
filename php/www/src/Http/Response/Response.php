<?php
declare(strict_types=1);

namespace Grafikart\Http\Response;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @Response
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http\Response
 */
class Response
{

    public function __construct(
        protected ?string $body,
        protected ?int $status = 200,
        protected array $headers = []
    )
    {
    }



    public function withBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }





    /**
     * @return string|null
    */
    public function getBody(): ?string
    {
        return $this->body;
    }




    public function withStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }





    /**
     * @return int|null
    */
    public function getStatus(): ?int
    {
        return $this->status;
    }



    public function withHeader(string $name, $value): self
    {
        $this->headers[$name] = $value;

        return $this;
    }





    public function withHeaders(array $headers): self
    {
        foreach ($headers as $name => $value) {
            $this->withHeader($name, $value);
        }

        return $this;
    }




    /**
     * @return array
    */
    public function getHeaders(): array
    {
        return $this->headers;
    }



    public function send(): void
    {
         if (php_sapi_name() !== 'cli') {
             $this->sendHeaders();
         }
    }


    public function sendHeaders(): void
    {
        /*
        if (headers_sent()) { return; }
        http_response_code($this->status);
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
        */
    }


    public function sendBody(): void
    {
        echo $this->body;
    }


    public function __toString(): string
    {
         return $this->getBody();
    }
}