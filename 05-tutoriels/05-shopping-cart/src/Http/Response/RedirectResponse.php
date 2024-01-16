<?php
declare(strict_types=1);

namespace Grafikart\Http\Response;

/**
 * RedirectResponse
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Http\Response
 */
class RedirectResponse extends Response
{


    /**
     * @param string $path
     * @param int $status
    */
    public function __construct(string $path, int $status = 302)
    {
        parent::__construct('', $status, ['Location' => $path]);
    }

}