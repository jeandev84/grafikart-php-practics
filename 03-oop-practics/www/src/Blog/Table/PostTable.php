<?php
declare(strict_types=1);

namespace App\Blog\Table;


/**
 * Created by PhpStorm at 05.12.2023
 *
 * @PostTable
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Blog\Table
 */
class PostTable
{

        protected $pdo;

        public function __construct(\PDO $pdo)
        {
            $this->pdo = $pdo;
        }


        /**
         * @return \stdClass[]
        */
        public function findPaginated(): array
        {

        }



        public function find(int $id): \stdClass
        {
            $query = $this->pdo->prepare("SELECT * FROM posts WHERE id = ?");
            $query->execute([$id]);
            return $query->fetch();
        }
}