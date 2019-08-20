<?php

namespace Itigoppo\BacklogApi\Connector;

use GuzzleHttp\Client;
use Itigoppo\BacklogApi\Exception\BacklogException;

class ApiKeyConnector extends Connector
{
    /** @var Client */
    protected $client;

    /** @var string */
    protected $api_key;

    public function __construct($space_id, $api_key, $domain = 'jp')
    {
        $this->client = new Client([
            'base_uri' => sprintf(self::API_URL, $space_id, $domain)
        ]);

        $this->api_key = $api_key;
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
