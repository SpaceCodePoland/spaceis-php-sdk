<?php

/**
 * Created with love by: PatryQHyper.pl
 * Date: 18.03.2022 22:34
 * Using: PhpStorm
 */

namespace SpaceCode\SpaceIs\Events;

use SpaceCode\SpaceIs\Exceptions\PaymentInitException;

class Transaction extends BaseEvent
{
    public function init(string $serverParam, string $productId, string $variantId, string $nick, string $method, string $email, ?string $additional = null, ?string $discountCodeId = null)
    {
        $response = $this->spaceIs->doRequest('/server/' . $serverParam . '/' . $productId . '/' . $variantId . '/payment/init', [
            'form_params' => [
                'nick' => $nick,
                'method' => $method,
                'email' => $email,
                'discount_code_id' => $discountCodeId,
                'additional' => $additional
            ]
        ], 'POST', false);

        $json = @json_decode($response->getBody());

        if ($json->message != false) throw new PaymentInitException($json->message);

        return $json->data;
    }

    public function info(string $transactionId, bool $extended = false)
    {
        $uri = '/transaction/' . $transactionId . '/info';
        if ($extended) $uri .= '/extended';
        return $this->spaceIs->doRequest($uri);
    }
}