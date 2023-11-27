<?php
declare(strict_types=1);

namespace Grafikart\Http;


/**
 * Created by PhpStorm at 27.11.2023
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
        protected ?int $status = 200,
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
     * @return int|null
    */
    public function getStatus(): ?int
    {
        return $this->status;
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
         // send headers
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