<?php
namespace Framework\Routing;

use Framework\Routing\Route\Route;

/**
 * @RouterInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Framework\Routing
*/
interface RouterInterface
{


    /**
     * Returns route domain
     *
     * @return string
    */
    public function getDomain(): string;





    /**
     * Returns all routes
     *
     * @return Route[]
    */
    public function getRoutes(): array;







    /**
     * Determine if the current request match route
     *
     * @param string $method
     *
     * @param string $path
     *
     * @return mixed
    */
    public function matchRoute(string $method, string $path): mixed;








    /**
     * Generate route URI
     *
     * @param string $name
     *
     * @param array $parameters
     *
     * @return string|null
    */
    public function generateUri(string $name, array $parameters = []): ?string;
}