<?php
declare(strict_types=1);

namespace App\Controller;


use Grafikart\Controller;
use Grafikart\Database\Builder\Facade\Query;
use Grafikart\Database\Builder\QueryBuilder;
use Grafikart\Http\Response;

/**
 * Created by PhpStorm at 02.12.2023
 *
 * @DemoController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller
 */
class DemoController extends Controller
{

      public function index()
      {
           # Fluent
           $qb  = new QueryBuilder($this->getConnection());
           $sqlFluent = $qb->select('id', 'title', 'content')
                     ->from('posts', 'p')
                     ->where('id = :id')
                     ->where('username = :username')
                     ->setParameter('username', 'some username')
                     ->setParameter('id', 3)
                     ->getSQL();



           # Facade
           $sqlFacade = Query::select('id', 'title', 'content')
              ->from('posts', 'p')
              ->where('p.category_id = :categoryId')
              ->where('p.created_at > NOW')
              ->getSQL();


           return new Response($sqlFluent . " ". $sqlFacade);
      }
}