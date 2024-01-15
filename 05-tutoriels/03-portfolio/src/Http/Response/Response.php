<?php
declare(strict_types=1);

namespace Grafikart\Http\Response;

use Grafikart\Http\MessageTrait;

/**
 * Response
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Http\Response
 */
class Response
{

        use MessageTrait;


        /**
         * @var int
        */
        protected int $statusCode;



        /**
         * @var string|null
        */
        protected ?string $body;



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
         * @param array $headers
         * @return $this
        */
        public function withHeaders(array $headers): static
        {
            $this->headers = array_merge($this->headers, $headers);

            return $this;
        }





        /**
         * @param $key
         * @param $value
         * @return $this
        */
        public function withHeader($key, $value): static
        {
            $this->headers[$key] = $value;

            return $this;
        }


        /**
         * @param int $statusCode
         * @return $this
        */
        public function withStatusCode(int $statusCode): static
        {
            $this->statusCode = $statusCode;

            return $this;
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




        /**
         * @return void
        */
        public function send(): void
        {
            http_response_code($this->statusCode);
            $this->sendHeaders();
        }




        /**
         * @return void
        */
        protected function sendHeaders(): void
        {
            $buffer = '';

            foreach ($this->headers as $key => $value) {
                 header("$key: $value");
            }

            if (ob_get_status()) {
                $buffer = ob_end_flush();
            }
        }
}