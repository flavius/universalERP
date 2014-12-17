<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\World;


use Common\World\Result\Boolean;

class CommandExecutor
{

    public function execute($command)
    {
        return new Boolean(true);
    }
}