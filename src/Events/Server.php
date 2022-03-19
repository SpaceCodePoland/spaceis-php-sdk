<?php

/**
 * Created with love by: PatryQHyper.pl
 * Date: 18.03.2022 22:34
 * Using: PhpStorm
 */

namespace SpaceCode\SpaceIs\Events;

class Server extends BaseEvent
{
    public function getAll()
    {
        return $this->spaceIs->doRequest('/servers');
    }

    public function getSpecific(string $serverParam)
    {
        return $this->spaceIs->doRequest('/server/' . $serverParam);
    }

    public function getCommands(string $serverId, string $serverToken)
    {
        return $this->spaceIs->doRequest('/server/' . $serverId . '/' . $serverToken . '/commands/get');
    }

    public function getLatestBuys(string $serverParam, int $limit = 10)
    {
        return $this->spaceIs->doRequest('/server/' . $serverParam . '/latest_buys', compact('limit'));
    }

    public function getRichest(string $serverParam, int $limit = 10)
    {
        return $this->spaceIs->doRequest('/server/' . $serverParam . '/richest', compact('limit'));
    }
}