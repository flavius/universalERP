<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\World;


use Common\World\Result\Boolean;

class World
{
    /**
     * @var Environment
     */
    private $environment;

    /**
     * @param Environment $environment
     */
    public function __construct(Environment $environment)
    {
        $adopted = $environment->adoptWorld($this);
        if (!$adopted) {
            throw new \RuntimeException("the environment has rejected this world for incompatibility reasons");
        }
    }


    /**
     * @param Command $command
     * @return Result
     */
    public function executeCommand(Command $command)
    {
        return new Boolean();
    }

    /**
     * @return Environment
     */
    public function environment()
    {
        return $this->environment;
    }

    public function setEnvironment(Environment $environment)
    {
        $this->environment = $environment;
    }
}