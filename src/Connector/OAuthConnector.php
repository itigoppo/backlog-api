<?php

namespace Itigoppo\BacklogApi\Connector;

use GuzzleHttp\Client;
use Itigoppo\BacklogApi\Connector\Configure\Configure;
use Itigoppo\BacklogApi\Exception\BacklogException;

class OAuthConnector extends Connector
{
    /** @var Client */
    protected $client;

    /**
     * OAuthConnector constructor.
     * @param Configure $config
     * @throws BacklogException
     */
    public function __construct(Configure $config)
    {
        if (empty($config->access_token) && empty($config->authorization_code)) {
            $query = http_build_query(
                [
                    'response_type' => 'code',
                    'client_id' => $config->client_id,
                    'redirect_uri' => $config->redirect_uri,
                    'state' => $config->state,
                ]
            );
            echo "Go to the following link in your browser:\n";
            echo $config->getOAuthAuthorizationURL() . '?' . $query;
            exit;
        }

        if (!empty($config->authorization_code)) {
            $client = new Client();
            $response = $client->request(
                'POST',
                $config->getOAuthAccessTokenURL(),
                [
                    'form_params' => [
                        'grant_type' => 'authorization_code',
                        'code' => $config->authorization_code,
                        'client_id' => $config->client_id,
                        'client_secret' => $config->client_secret,
                        'redirect_uri' => $config->redirect_uri,
                    ],
                ]
            );
            $token = json_decode($response->getBody()->getContents());

            echo "Your access token:\n";
            echo $token->access_token . "\n\n";
            echo "Your token expires:\n";
            echo $token->expires_in . "\n\n";
            echo "Your refresh token:\n";
            echo $token->refresh_token;
            exit;
        }

        if (empty($config->access_token)) {
            throw new BacklogException('access_token must not be null');
        }

        $this->client = new Client(
            [
                'base_uri' => $config->getApiBaseURL(),
                'headers' => [
                    'Authorization' => 'Bearer ' . $config->access_token,
                ],
            ]
        );
    }

    public function get($path, $form_params = [], $query_params = [], $headers = [])
    {
        try {
            $response = $this->client->request(
                'GET',
                $path,
                [
                    'headers' => $this->client->getConfig('headers') + $headers,
                    'query' => $query_params,
                    'form_params' => $form_params,
                ]
            );
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
        // TODO: Implement post() method.
    }

    public function put($path, $form_params = [], $query_params = [], $headers = [])
    {
        // TODO: Implement put() method.
    }

    public function patch($path, $form_params = [], $query_params = [], $headers = [])
    {
        // TODO: Implement patch() method.
    }

    public function delete($path, $form_params = [], $query_params = [], $headers = [])
    {
        // TODO: Implement delete() method.
    }

    public function postFile($path, $multipart, $query_params = [], $headers = [])
    {
        // TODO: Implement postFile() method.
    }

    public function getFile($path, $form_params = [], $query_params = [], $headers = [])
    {
        // TODO: Implement getFile() method.
    }
}
