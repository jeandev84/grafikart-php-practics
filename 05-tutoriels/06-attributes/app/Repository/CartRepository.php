<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Cart;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Repository\EntityRepository;
use Grafikart\Database\ORM\Repository\ServiceRepository;

/**
 * CartRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Repository
 */
class CartRepository extends ServiceRepository
{
    public function __construct(PdoConnection $connection)
    {
        parent::__construct($connection, Cart::class);
    }
}