<?php

/**
 * Created with love by: PatryQHyper.pl
 * Date: 18.03.2022 22:34
 * Using: PhpStorm
 */

namespace SpaceCode\SpaceIs\Events;

class Subpage extends BaseEvent
{
    public function get(string $slug)
    {
        return $this->spaceIs->doRequest('/subpage/' . $slug);
    }
}