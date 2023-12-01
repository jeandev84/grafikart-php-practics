<?php
declare(strict_types=1);

namespace App\Controller;


use Grafikart\Controller;
use Grafikart\Http\Response;

/**
 * Created by PhpStorm at 01.12.2023
 *
 * @HomeController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller
 */
class SiteController extends Controller
{
     public function index(): Response
     {
         $connection = $this->getConnection();
         $date       = date('Y-m-d H:i:s');
         $count      = $connection->executeQuery(
                         sprintf('INSERT INTO articles SET title="Mon titre", created_at="%s"', $date)
                       );

         dd($count);
         return $this->render('home');
     }



     public function single(): Response
     {
         return $this->render('single');
     }
}