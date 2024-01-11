<?php
declare(strict_types=1);

namespace App\Http;


/**
 * MessageTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http
 */
trait MessageTrait
{
    /**
     * @var string
    */
    protected string $protocolVersion;




    /**
     * @param string $version
     * @return $this
    */
    public function withProtocolVersion(string $version): static
    {
        $this->protocolVersion = $version;

        return $this;
    }





    /**
     * @return string
    */
    public function getProtocolVersion(): string
    {
        return $this->protocolVersion;
    }


}