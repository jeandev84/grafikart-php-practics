<?php
declare(strict_types=1);

namespace App\Http;

/**
 * Response
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http
 */
class Response
{

        use MessageTrait;


        /**
         * @var int
        */
        protected int $statusCode;



        /**
         * @var string
        */
        protected string $body;



        /**
         * @var array
        */
        protected array $headers = [];


        /**
         * @param string|null $body
         * @param int $status
         * @param array $headers
        */
        public function __construct(string $body = null, int $status = 200, array $headers = [])
        {
           $this->body       = $body;
           $this->statusCode = $status;
           $this->headers    = $headers;
        }





        /**
         * @return int
        */
        public function getStatusCode(): int
        {
           return $this->statusCode;
        }




        /**
         * @return array
        */
        public function getHeaders(): array
        {
           return $this->headers;
        }




        /**
         * @return string
        */
        public function getBody(): string
        {
            return $this->body;
        }






        public function send(): void
        {
            http_response_code($this->statusCode);
        }
}