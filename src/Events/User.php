<?php

/**
 * Created with love by: PatryQHyper.pl
 * Date: 18.03.2022 22:34
 * Using: PhpStorm
 */

namespace SpaceCode\SpaceIs\Events;

class User extends BaseEvent
{
    public function me()
    {
        return $this->spaceIs->doRequest('/me');
    }
}