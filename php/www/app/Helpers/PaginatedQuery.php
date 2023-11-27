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
      protected $connection;
      protected $perPage;
      protected $count;

      public function __construct(
          string $query,
          string $queryCount,
          ?PdoConnection $connection = null,
          int $perPage = 12
      )
      {
          $this->query = $query;
          $this->queryCount = $queryCount;
          $this->connection   = $connection ?: Connection::make();
          $this->perPage = $perPage;
      }



      public function getItems(string $classMapping): array
      {
          $currentPage = $this->getCurrentPage();
          $pages       =  $this->getTotalPages();
          if ($currentPage > $pages) {
              throw new Exception("Cette page n' existe pas");
          }

          $offset = $this->perPage * ($currentPage - 1);

         return $this->connection->query( "$this->query LIMIT {$this->perPage} OFFSET $offset")
                                 ->map($classMapping)
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



    public function nextLink(string $link): ?string
    {
        $currentPage = $this->getCurrentPage();
        $pages       = $this->getTotalPages();
        if ($currentPage >= $pages) return null;
        $link .= "?page=". ($currentPage + 1);
        return sprintf('<a href="%s" class="btn btn-primary ml-auto">Page suivante &raquo;</a>', $link);
    }


      private function getCurrentPage(): int
      {
          return URL::getPositiveInt('page', 1);
      }



    /**
     * @return float
     */
    public function getTotalPages(): float
    {
        if (! $this->count) {
            $this->count = (int)$this->connection
                ->query($this->queryCount)
                ->fetch()
                ->nums()[0];
        }

        return ceil($this->count / $this->perPage);
    }

}