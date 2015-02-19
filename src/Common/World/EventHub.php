<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\World;


interface EventHub
{

    /**
     * @return Event[]
     */
    public function newEvents();

    /**
     * @param Event $event
     */
    public function trigger(Event $event);

    /**
     * @return string
     */
    public function __toString();

    /**
     * @return StorageDriver
     */
    public function storageDriver();

    /**
     * @param StorageDriver $storage
     * @return void
     */
    public function setStorageDriver(StorageDriver $storage);
}