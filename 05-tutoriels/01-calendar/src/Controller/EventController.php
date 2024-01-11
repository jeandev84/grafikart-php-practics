<?php
declare(strict_types=1);

namespace App\Controller;

use App\AbstractController;
use App\Http\Response;

/**
 * EventController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Controller
 */
class EventController extends AbstractController
{
      public function index(): Response
      {
          return $this->render('events/index.php');
      }
}