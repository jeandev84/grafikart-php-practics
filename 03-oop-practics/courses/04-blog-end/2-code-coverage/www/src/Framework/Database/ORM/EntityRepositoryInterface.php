<?php
declare(strict_types=1);

namespace Framework\Database\ORM;


/**
 * Created by PhpStorm at 06.12.2023
 *
 * @EntityRepositoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Database\ORM
 */
interface EntityRepositoryInterface
{

      /**
       * @param int $id
       * @return mixed
      */
      public function find(int $id): mixed;


      /**
       * @return mixed
      */
      public function findAll(): mixed;


      /**
       * @param array $data
       * @param int $id
       * @return mixed
      */
      public function update(array $data, int $id): mixed;


      /**
       * @param array $data
       * @return mixed
      */
      public function insert(array $data): mixed;




      /**
       * @param int $id
       * @return mixed
      */
      public function delete(int $id): mixed;
}