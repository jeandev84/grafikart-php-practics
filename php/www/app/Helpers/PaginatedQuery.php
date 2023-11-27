<?php
declare(strict_types=1);

namespace App\Helpers;


use App\Database\Connection\PdoConnection;
use Exception;

/**
 * Created by PhpStorm at 26.11.2023
 *
 * @PaginatedQuery
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Helpers
 */
class PaginatedQuery
{


      protected $query;
      protected $queryCount;
      protected $classMapping;
      protected $connection;
      protected $perPage;


      public function __construct(
          string $query,
          string $queryCount,
          string $classMapping,
          ?PdoConnection $connection = null,
          int $perPage = 12
      )
      {
          $this->query = $query;
          $this->queryCount = $queryCount;
          $this->classMapping = $classMapping;
          $this->connection   = $connection ?: Connection::make();
          $this->perPage = $perPage;
      }



      public function getItems(): array
      {
          $currentPage = $this->getCurrentPage();
          $count       = (int)$this->connection
                                   ->query($this->queryCount)
                                   ->fetch()
                                   ->nums()[0];
          $pages = ceil($count / $this->perPage);

          if ($currentPage > $pages) {
              throw new Exception("Cette page n' existe pas");
          }

          $offset = $this->perPage * ($currentPage - 1);

         return $this->connection->query( "$this->query LIMIT {$this->perPage} OFFSET $offset")
                                 ->map($this->classMapping)
                                 ->fetch()
                                 ->all();
      }



      public function previousLink(string $link): ?string
      {
          $currentPage = $this->getCurrentPage();
          if ($currentPage <= 1) return null;
          if ($currentPage > 2) $link .= "?page=". ($currentPage - 1);
          return sprintf('<a href="%s" class="btn btn-primary">&laquo; Page precedente</a>', $link);
      }



      private function getCurrentPage(): int
      {
          return URL::getPositiveInt('page', 1);
      }
}