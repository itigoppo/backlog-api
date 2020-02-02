<?php

namespace Itigoppo\BacklogApi\Connector\Configure;

interface ConfigureInterface
{
    /**
     * api base url
     *
     * @return string
     */
    public function getApiBaseURL();

    /**
     * OAuth authorization url
     *
     * @return string
     */
    public function getOAuthAuthorizationURL();

    /**
     * OAuth access token url
     *
     * @return string
     */
    public function getOAuthAccessTokenURL();
}
