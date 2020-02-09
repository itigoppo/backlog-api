<?php

namespace Itigoppo\BacklogApi\Connector;

use GuzzleHttp\Client;
use Itigoppo\BacklogApi\Connector\Configure\Configure;
use Itigoppo\BacklogApi\Exception\BacklogException;

class OAuthConnector extends Connector
{
    /** @var Client */
    private $client;

    /** @var string */
    private $base_uri;

    /** @var string */
    private $client_id;

    /** @var string */
    private $client_secret;

    /** @var string */
    private $redirect_uri;

    /** @var string */
    private $state;

    /** @var string */
    private $authorization_code;

    /** @var string */
    private $base_oauth_authorization_url;

    /** @var string */
    private $base_oauth_access_token_url;

    /** @var string */
    private $access_token;

    /** @var string */
    private $refresh_token;

    /** @var string */
    private $token_type;

    /**
     * OAuthConnector constructor.
     *
     * @param Configure $config
     */
    public function __construct(Configure $config)
    {
        $this->base_uri = $config->getBaseApiURL();
        $this->client_id = $config->client_id;
        $this->client_secret = $config->client_secret;
        $this->redirect_uri = $config->redirect_uri;
        $this->state = $config->state;
        $this->authorization_code = $config->authorization_code;
        $this->access_token = $config->access_token;
        $this->refresh_token = $config->refresh_token;
        $this->base_oauth_authorization_url = $config->getBaseOAuthAuthorizationURL();
        $this->base_oauth_access_token_url = $config->getBaseOAuthAccessTokenURL();
    }

    public function setClient()
    {
        if (empty($this->refresh_token)) {
            $token = $this->getOAuthAccessToken();
        } else {
            $token = $this->getOAuthRefreshAccessToken();
        }

        $this->access_token = $token->access_token;
        $this->refresh_token = $token->refresh_token;
        $this->token_type = $token->token_type;

        $this->client = new Client(
            [
                'base_uri' => $this->base_uri,
                'headers' => [
                    'Authorization' => $this->token_type . ' ' . $this->access_token,
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
        try {
            $response = $this->client->request(
                'POST',
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

        return json_decode($response->getBody()->getContents());
    }

    public function put($path, $form_params = [], $query_params = [], $headers = [])
    {
        try {
            $response = $this->client->request(
                'PUT',
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

        return json_decode($response->getBody()->getContents());
    }

    public function patch($path, $form_params = [], $query_params = [], $headers = [])
    {
        try {
            $response = $this->client->request(
                'PATCH',
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

        return json_decode($response->getBody()->getContents());
    }

    public function delete($path, $form_params = [], $query_params = [], $headers = [])
    {
        try {
            $response = $this->client->request(
                'DELETE',
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

        return json_decode($response->getBody()->getContents());
    }

    public function postFile($path, $multipart, $query_params = [], $headers = [])
    {
        try {
            $response = $this->client->request(
                'POST',
                $path,
                [
                    'headers' => $this->client->getConfig('headers') + $headers,
                    'query' => $query_params,
                    'multipart' => $multipart
                ]
            );
        } catch (\Exception $exception) {
            throw new BacklogException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }

        return json_decode($response->getBody()->getContents());
    }

    public function getFile($path, $form_params = [], $query_params = [], $headers = [])
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

    /**
     * 認可コード取得用URL
     *
     * @return string|null
     */
    public function getOAuthAuthorizationURL()
    {
        if (empty($this->client_id)) {
            return null;
        }

        $query = http_build_query(
            [
                'response_type' => 'code',
                'client_id' => $this->client_id,
                'redirect_uri' => $this->redirect_uri,
                'state' => $this->state,
            ]
        );

        return $this->base_oauth_authorization_url . '?' . $query;
    }

    /**
     * アクセストークン取得
     *
     * @return mixed|null
     * @throws BacklogException
     */
    public function getOAuthAccessToken()
    {
        if (empty($this->authorization_code) || empty($this->client_id) || empty($this->client_secret)) {
            throw new BacklogException('Unable to create access token');
        }

        try {
            $client = new Client();
            $response = $client->request(
                'POST',
                $this->base_oauth_access_token_url,
                [
                    'form_params' => [
                        'grant_type' => 'authorization_code',
                        'code' => $this->authorization_code,
                        'client_id' => $this->client_id,
                        'client_secret' => $this->client_secret,
                        'redirect_uri' => $this->redirect_uri,
                    ],
                ]
            );
        } catch (\Exception $exception) {
            $error = json_decode($exception->getMessage());
            if (!empty($error->error_description) && $error->error_description === 'The access token expired') {
                return 'refresh';
            }

            throw new BacklogException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }

        if ($response->getStatusCode() != '200') {
            throw new BacklogException('', $response->getStatusCode());
        }

        return json_decode($response->getBody()->getContents());
    }

    /**
     * アクセストークン更新
     *
     * @return mixed|null
     * @throws BacklogException
     */
    public function getOAuthRefreshAccessToken()
    {
        if (empty($this->client_id) || empty($this->client_secret) || empty($this->refresh_token)) {
            throw new BacklogException('Unable to update access token');
        }

        try {
            $client = new Client();
            $response = $client->request(
                'POST',
                $this->base_oauth_access_token_url,
                [
                    'form_params' => [
                        'grant_type' => 'refresh_token',
                        'client_id' => $this->client_id,
                        'client_secret' => $this->client_secret,
                        'refresh_token' => $this->refresh_token,
                    ],
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
}
