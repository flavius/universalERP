<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\World;


interface Event
{

    /**
     * @param Event $other
     * @return bool
     */
    public function equals(Event $other);
}