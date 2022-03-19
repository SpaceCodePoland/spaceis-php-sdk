<?php

/**
 * Created with love by: PatryQHyper.pl
 * Date: 18.03.2022 22:38
 * Using: PhpStorm
 */

namespace SpaceCode\SpaceIs\Events;

use SpaceCode\SpaceIs\SpaceIs;

class BaseEvent
{
    protected SpaceIs $spaceIs;

    public function __construct(SpaceIs $spaceIs)
    {
        $this->spaceIs = $spaceIs;
    }
}