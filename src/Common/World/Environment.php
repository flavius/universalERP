<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\World;


interface Environment {

    /**
     * @param World $world
     * @return bool
     */
    public function adoptWorld(World $world);

    public function importEnvironment(Environment $other);
}