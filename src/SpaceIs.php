<?php

/**
 * Created with love by: PatryQHyper.pl
 * Date: 18.03.2022 22:15
 * Using: PhpStorm
 */

namespace SpaceCode\SpaceIs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\GuzzleException;
use SpaceCode\SpaceIs\Events\DiscountCode;
use SpaceCode\SpaceIs\Events\Subpage;
use SpaceCode\SpaceIs\Events\Transaction;
use SpaceCode\SpaceIs\Events\Variant;
use SpaceCode\SpaceIs\Events\Server;
use SpaceCode\SpaceIs\Events\User;
use SpaceCode\SpaceIs\Events\Voucher;
use SpaceCode\SpaceIs\Exceptions\LicenseExpiredException;
use SpaceCode\SpaceIs\Exceptions\NotFoundHttpException;
use SpaceCode\SpaceIs\Exceptions\RateLimitException;
use SpaceCode\SpaceIs\Exceptions\ServerErrorException;
use SpaceCode\SpaceIs\Exceptions\UnauthorizedException;

class SpaceIs
{
    protected string $apiKey;
    protected string $apiUrl;

    public User $user;
    public Server $server;
    public Variant $variant;
    public Transaction $transaction;
    public Subpage $subpage;
    public DiscountCode $discountCode;
    public Voucher $voucher;

    public const version = '1.0.0';

    public function __construct(string $apiKey, ?string $apiUrl = 'https://api.spaceis.pl/v3')
    {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;

        $this->user = new User($this);
        $this->server = new Server($this);
        $this->variant = new Variant($this);
        $this->transaction = new Transaction($this);
        $this->subpage = new Subpage($this);
        $this->discountCode = new DiscountCode($this);
        $this->voucher = new Voucher($this);
    }

    /**
     * Send Guzzle request to SpaceIs API.
     *
     * @throws RateLimitException
     * @throws UnauthorizedException
     * @throws LicenseExpiredException
     * @throws ServerErrorException
     * @throws NotFoundHttpException
     */
    public function doRequest(string $uri, array $payload = [], string $method = 'GET', bool $getBody = true, bool $throwExceptionOnNotFound = true)
    {
        $method = strtoupper($method);

        $client = new Client();

        try {
            $payload['headers']['User-Agent'] = 'spaceis-php-sdk/' . self::version;
            $payload['headers']['Accept'] = 'application/json';
            $payload['headers']['Authorization'] = 'Bearer ' . $this->apiKey;

            $response = $client->request($method, $this->apiUrl . $uri, $payload);

            if ($getBody) return json_decode($response->getBody());

        } catch (RequestException | GuzzleException $exception) {
            $response = $exception->getResponse();

            switch ($response->getStatusCode()) {
                case 402:
                    throw new LicenseExpiredException($response->getBody());
                    break;
                case 401:
                    throw new UnauthorizedException($response->getBody());
                    break;
                case 500:
                    throw new ServerErrorException($response->getBody());
                    break;
                case 429:
                    throw new RateLimitException($response->getBody());
                    break;
            }

            if ($response->getStatusCode() == 404 && $throwExceptionOnNotFound) throw new NotFoundHttpException($response->getBody());
        }

        return $response;
    }
}