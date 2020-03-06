<?php

namespace Itigoppo\BacklogApi\Connector\Configure;

interface ConfigureInterface
{
    /**
     * base api url
     *
     * @return string
     */
    public function getBaseApiURL();

    /**
     * base OAuth authorization url
     *
     * @return string
     */
    public function getBaseOAuthAuthorizationURL();

    /**
     * base OAuth access token url
     *
     * @return string
     */
    public function getBaseOAuthAccessTokenURL();
}
