<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\World;


interface Query
{
    /**
     * @param EventHub $eventHub
     * @return mixed
     */
    public function __invoke(EventHub $eventHub);
}