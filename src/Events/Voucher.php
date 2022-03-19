<?php

/**
 * Created with love by: PatryQHyper.pl
 * Date: 18.03.2022 22:34
 * Using: PhpStorm
 */

namespace SpaceCode\SpaceIs\Events;

use SpaceCode\SpaceIs\Exceptions\VoucherNotFoundException;
use SpaceCode\SpaceIs\Exceptions\VoucherUsedException;

class Voucher extends BaseEvent
{
    public function use(string $nick, string $code)
    {
        $request = $this->spaceIs->doRequest('/voucher', [
            'form_params' => [
                'code' => $code,
                'nick' => $nick
            ]
        ], 'POST', false, false);

        switch ($request->getStatusCode()) {
            case 404:
                throw new VoucherNotFoundException();
                break;
            case 403:
                throw new VoucherUsedException();
                break;
            case 200:
                return json_decode($request->getBody());
                break;
            default:
                throw new \Exception('unexpected error ' . $request->getStatusCode());
        }
    }
}