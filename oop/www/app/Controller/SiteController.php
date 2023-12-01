<?php
declare(strict_types=1);

namespace App\Controller;


use App\Repository\PostRepository;
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
         return $this->render('home');
     }



     public function single(): Response
     {
         return $this->render('single');
     }
}