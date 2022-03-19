<?php

/**
 * Created with love by: PatryQHyper.pl
 * Date: 18.03.2022 22:34
 * Using: PhpStorm
 */

namespace SpaceCode\SpaceIs\Events;

class Variant extends BaseEvent
{
    public function get(string $serverParam, string $productId)
    {
        return $this->spaceIs->doRequest('/server/' . $serverParam . '/' . $productId . '/variants');
    }
}