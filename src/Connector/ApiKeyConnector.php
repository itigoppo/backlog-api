<?php

namespace Itigoppo\BacklogApi\Connector;

use GuzzleHttp\Client;
use Itigoppo\BacklogApi\Connector\Configure\Configure;
use Itigoppo\BacklogApi\Exception\BacklogException;

class ApiKeyConnector extends Connector
{
    /** @var Client */
    private $client;

    /** @var string */
    private $base_uri;

    /** @var string */
    private $api_key;

    /**
     * ApiKeyConnector constructor.
     *
     * @param Configure $config
     * @throws BacklogException
     */
    public function __construct(Configure $config)
    {
        if (empty($config->api_key)) {
            throw new BacklogException('api_key must not be null');
        }

        $this->base_uri = $config->getBaseApiURL();
        $this->api_key = $config->api_key;
    }

    public function setClient()
    {
        $this->client = new Client([
            'base_uri' => $this->base_uri,
        ]);
    }

    public function get($path, $form_params = [], $query_params = [], $headers = [])
    {
        try {
            $response = $this->client->request('GET', $path, [
                'headers' => $headers,
                'query' => ['apiKey' => $this->api_key] + $query_params,
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

    public function post($path, $form_params = [], $query_params = [], $headers = [])
    {
        try {
            $response = $this->client->request('POST', $path, [
                'headers' => $headers,
                'query' => ['apiKey' => $this->api_key] + $query_params,
                'form_params' => $form_params,
            ]);
        } catch (\Exception $exception) {
            throw new BacklogException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }

        return json_decode($response->getBody()->getContents());
    }

    public function put($path, $form_params = [], $query_params = [], $headers = [])
    {
        try {
            $response = $this->client->request('PUT', $path, [
                'headers' => $headers,
                'query' => ['apiKey' => $this->api_key] + $query_params,
                'form_params' => $form_params,
            ]);
        } catch (\Exception $exception) {
            throw new BacklogException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }

        return json_decode($response->getBody()->getContents());
    }

    public function patch($path, $form_params = [], $query_params = [], $headers = [])
    {
        try {
            $response = $this->client->request('PATCH', $path, [
                'headers' => $headers,
                'query' => ['apiKey' => $this->api_key] + $query_params,
                'form_params' => $form_params,
            ]);
        } catch (\Exception $exception) {
            throw new BacklogException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }

        return json_decode($response->getBody()->getContents());
    }

    public function delete($path, $form_params = [], $query_params = [], $headers = [])
    {
        try {
            $response = $this->client->request('DELETE', $path, [
                'headers' => $headers,
                'query' => ['apiKey' => $this->api_key] + $query_params,
                'form_params' => $form_params,
            ]);
        } catch (\Exception $exception) {
            throw new BacklogException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }

        return json_decode($response->getBody()->getContents());
    }

    public function postFile($path, $multipart, $query_params = [], $headers = [])
    {
        try {
            $response = $this->client->request('POST', $path, [
                'headers' => $headers,
                'query' => ['apiKey' => $this->api_key] + $query_params,
                'multipart' => $multipart
            ]);
        } catch (\Exception $exception) {
            throw new BacklogException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }

        return json_decode($response->getBody()->getContents());
    }

    public function getFile($path, $form_params = [], $query_params = [], $headers = [])
    {
        try {
            $response = $this->client->request('GET', $path, [
                'headers' => $headers,
                'query' => ['apiKey' => $this->api_key] + $query_params,
                'form_params' => $form_params,
            ]);
        } catch (\Exception $exception) {
            throw new BacklogException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }

        if ($response->getStatusCode() != '200') {
            throw new BacklogException('', $response->getStatusCode());
        }

        // Return the whole response object for further processing
        return $response;
    }
}
