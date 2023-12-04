<?php
declare(strict_types=1);

namespace App\Queing;


/**
 * Created by PhpStorm at 04.12.2023
 *
 * @EnqueListener
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Queing
 */
class EnqueueListener
{
        protected $processAsync;


        public function __construct(callable $processAsync)
        {
            $this->processAsync = $processAsync;
        }


        /**
         * @return callable
        */
        public function getProcessAsync(): callable
        {
            return $this->processAsync;
        }
}