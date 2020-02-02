<?php

namespace Itigoppo\BacklogApi\Connector\Configure;

use Itigoppo\BacklogApi\Exception\BacklogException;
use Itigoppo\BacklogApi\Traits\PrivateGetterTrait;

/**
 * @property-read string $space_id
 * @property-read string $api_key
 * @property-read string $access_token
 * @property-read string $client_id
 * @property-read string $client_secret
 * @property-read string $redirect_uri
 * @property-read string $state
 * @property-read string $authorization_code
 * @property-read string $refresh_token
 */
abstract class Configure implements ConfigureInterface
{
    use PrivateGetterTrait;

    /** @var string */
    private $space_id;
    /** @var string */
    private $api_key;
    /** @var string */
    private $access_token;
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
    private $refresh_token;

    /**
     * Configure constructor.
     * @param array $options
     * @throws BacklogException
     */
    public function __construct($options)
    {
//        $get_authorization_code = false;
//        if (isset($options['get_authorization_code'])) {
//            $get_authorization_code = (bool)$options['get_authorization_code'];
//        }
//        $get_access_token = false;
//        if (isset($options['get_access_token'])) {
//            $get_access_token = (bool)$options['get_access_token'];
//        }
//        if ($get_authorization_code === true && $get_access_token === true) {
//            throw new BacklogException('Do you get an authentication code or an access token?');
//        }

        if (empty($options['space_id'])) {
            throw new BacklogException('space_id must not be null');
        }

        if (
            empty($options['api_key'])
            && empty($options['access_token'])
            && empty($options['client_id'])
            && empty($options['client_secret'])
        ) {
            throw new BacklogException('client_id and client_secret must not be null');
        }

//        if (
//            empty($options['api_key'])
//            && (
//                empty($options['access_token'])
//                && $get_authorization_code === false
//                && $get_access_token === false
//            )
//        ) {
//            throw new BacklogException('api_key or access_token must not be null');
//        }
//
//        if ($get_authorization_code === true && empty($options['client_id']) && empty($options['client_secret'])) {
//            throw new BacklogException('client_id and client_secret must not be null');
//        }
//
//        if (
//            $get_access_token === true
//            && empty($options['client_id'])
//            && empty($options['client_secret'])
//            && empty($options['authorization_code'])
//        ) {
//            throw new BacklogException('client_id and client_secret and authorization_code must not be null');
//        }

        $this->space_id = $options['space_id'];
        $this->api_key = isset($options['api_key']) ? $options['api_key'] : null;
        $this->access_token = isset($options['access_token']) ? $options['access_token'] : null;
        $this->client_id = isset($options['client_id']) ? $options['client_id'] : null;
        $this->client_secret = isset($options['client_secret']) ? $options['client_secret'] : null;
        $this->redirect_uri = isset($options['redirect_uri']) ? $options['redirect_uri'] : null;
        $this->state = isset($options['state']) ? $options['state'] : null;
        $this->authorization_code = isset($options['authorization_code']) ? $options['authorization_code'] : null;
        $this->refresh_token = isset($options['refresh_token']) ? $options['refresh_token'] : null;
    }
}
