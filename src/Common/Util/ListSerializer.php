<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\Util;


class ListSerializer
{
    /**
     * @var array[mixed]
     */
    private $list;

    public function __construct($list)
    {
        $this->list = $list;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $strings = [];
        $pos = 0;
        foreach ($this->list as $name => $item) {
            if(get_class($item) === "Closure") {
                $item = new ClosureSerializer($item);
            }
            if($pos == 0 && $name != 0) {
                $strings[] = "$name=$item";
            } else {
                $strings[] = "$item";
            }
            $pos = 1;
        }
        return implode(", ", $strings);
    }
}