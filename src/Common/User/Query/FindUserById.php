<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\User\Query;

use Common\User\User;
use Common\World\EventHub;
use Common\World\Query;

class FindUserById implements Query
{
    /**
     * @var string
     */
    private $userId;

    /**
     * @param string $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param EventHub $eventHub
     * @return User
     */
    public function __invoke(EventHub $eventHub) {
        $user = new User();
        foreach($eventHub->newEvents() as $event) {
            $user->apply($event);
        }
        return $user;
    }
}