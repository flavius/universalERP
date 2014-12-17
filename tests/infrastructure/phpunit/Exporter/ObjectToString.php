<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace TestFramework\Exporter;


class ObjectToString {

    public function export($value, $indentation = 0)
    {
        return str_repeat(' ', $indentation) . "$value";
    }
}