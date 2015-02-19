<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\World;


class QueryExecutor
{
    /**
     * @var EventHub
     */
    private $eventHub;

    /**
     * @param EventHub $eventHub
     */
    public function __construct(EventHub $eventHub)
    {
        $this->eventHub = $eventHub;
    }

    /**
     * @param Query $query
     * @return mixed
     */
    public function execute(Query $query)
    {
        return $query($this->eventHub);
    }
}