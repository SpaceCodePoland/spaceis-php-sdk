<?php

/**
 * Created with love by: PatryQHyper.pl
 * Date: 18.03.2022 22:34
 * Using: PhpStorm
 */

namespace SpaceCode\SpaceIs\Events;

class DiscountCode extends BaseEvent
{
    public function get(string $code)
    {
        return $this->spaceIs->doRequest('/discount_code/' . $code);
    }
}