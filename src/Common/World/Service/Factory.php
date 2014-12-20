<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\World\Service;


interface Factory
{
    /**
     * @param array $parameters
     * @return Service
     */
    public function newInstance(array $parameters);
}