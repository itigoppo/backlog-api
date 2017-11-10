<?php

namespace Itigoppo\Backlog\Connector;


use GuzzleHttp\Client;
use Itigoppo\Backlog\Exception\BacklogException;

class ApiKeyConnector extends Connector
{
    /** @var Client */
    protected $client;

    protected $api_key;

    public function __construct($space_id, $api_key)
    {
        $this->client = new Client([
            'base_uri' => sprintf(self::API_URL, $space_id)
        ]);

        $this->api_key = $api_key;
    }

    public function get($path, $form_params = [], $headers = [])
    {
        try {
            $response = $this->client->request('GET', $path, [
                'headers' => $headers,
                'query' => ['apiKey' => $this->api_key],
                'form_params' => $form_params,
            ]);

        } catch (\Exception $exception) {
            throw new BacklogException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }

        if ($response->getStatusCode() != '200') {
            throw new BacklogException('', $response->getStatusCode());
        }

        return json_decode($response->getBody()->getContents());
    }

    public function post($path, $form_params = [], $headers = [])
    {
        try {
            $response = $this->client->request('POST', $path, [
                'headers' => $headers,
                'query' => ['apiKey' => $this->api_key],
                'form_params' => $form_params,
            ]);
        } catch (\Exception $exception) {
            throw new BacklogException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }

        return json_decode($response->getBody()->getContents());
    }
}
