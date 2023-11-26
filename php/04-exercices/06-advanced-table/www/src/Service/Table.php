<?php
declare(strict_types=1);

namespace App\Service;


use App\Database\Connection\QueryBuilder;
use App\Helper\URLHelper;

/**
 * Created by PhpStorm at 26.11.2023
 *
 * @Table
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Service
 */
class Table
{


    const SORT_KEY = 'sort';
    const DIR_KEY = 'dir';

    protected QueryBuilder $query;

    /**
     * Request params $_GET
     *
     * @var array
    */
    protected array $get = [];
    protected array $sortable = [];
    protected array $columns = [];
    protected array $formatters = [];
    protected int $limit = 20;


    public function __construct(QueryBuilder $query, array $queries)
    {
        $this->query   = $query;
        $this->get = $queries;
    }



    public function sortable(string ...$sortable): self
    {
         $this->sortable = $sortable;

         return $this;
    }



    public function format(string $key, callable $func): self
    {
          $this->formatters[$key] = $func;

          return $this;
    }



    public function columns(array $columns): self
    {
        $this->columns = $columns;

        return $this;
    }




    private function th(string $key): string
    {
        if (! in_array($key, $this->sortable)) {
            return $this->columns[$key];
        }

        $sort      = $this->get[self::SORT_KEY] ?? null;
        $direction = $this->get[self::DIR_KEY] ?? null;
        $icon      = "";
        if ($sort === $key) { $icon = ($direction === 'asc' ? "^" : "v"); }

        $url = URLHelper::withParams($this->get, [
            self::SORT_KEY => $key,
            self::DIR_KEY => ($direction === 'asc' && $sort === $key) ? 'desc' : 'asc'
        ]);

        return sprintf('<a href="?%s">%s %s</a>', $url, $this->columns[$key], $icon);
    }



    private function td(string $key, array $item)
    {
         if (isset($this->formatters[$key])) {
             return $this->formatters[$key]($item[$key]);
         }

         return $item[$key];
    }



    public function render()
    {
        $page  = $this->page();
        $count = (clone $this->query)->count();

        if (! empty($this->get['sort']) && in_array($this->get['sort'], $this->sortable)) {
            $this->query->orderBy($this->get['sort'], $this->get['dir'] ?? 'asc');
        }

        $items = $this->query
                      ->select(array_keys($this->columns))
                      ->limit($this->limit)
                      ->page($page)
                      ->fetchAll();


        $pages = ceil($count / $this->limit);

        $thead  = $this->thead($this->columns);
        $tbody  = $this->tbody($items);
        $links  = $this->getLinks($pages);

        return <<<HTML
           <table class="table table-striped">
               <thead>$thead</thead>
               <tbody>$tbody</tbody>  
           </table>
           <div class="pagination">$links</div>
HTML;

    }



    public function thead(array $columns): string
    {
        $thead[] = "<tr>";
        foreach ($columns as $key => $column) {
            $thead[] = "<th>{$this->th($key)}</th>";
        }
        $thead[] = "<tr>";

        return join(PHP_EOL, $thead);
    }




    public function tbody(array $items): string
    {
        $tbody = [];
        foreach ($items as $item) {
            $tbody[] = "<tr>";
            foreach ($this->columns as $key => $column) {
                /* $tbody[] = "<td>$item[$key]</td>"; */
                $tbody[] = "<td>{$this->td($key, $item)}</td>";
            }
            $tbody[] = "</tr>";
        }

        return join(PHP_EOL, $tbody);
    }



    public function getLinks($pages)
    {
         $page = $this->page();

         if ($pages > 1 && $page > 1) {
             $link = \App\Helper\URLHelper::withParam($this->get, 'page', $page - 1);
             return sprintf('<a href="?%s" class="btn btn-primary">Previous page</a>', $link);
         }

         if ($pages > 1 && $page < $pages) {
             $link = \App\Helper\URLHelper::withParam($this->get, 'page', $page + 1);
             return sprintf('<a href="?%s" class="btn btn-primary">Next page</a>', $link);
         }
    }



    /**
     * @param int $limit
     * @return $this
    */
    public function limit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }


    public function page(): int
    {
        return (int)($this->get['page'] ?? 1);
    }

}