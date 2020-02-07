<?php

namespace Itigoppo\BacklogApi\Connector\Configure;

class BacklogComConfigure extends Configure
{
    public function getBaseApiURL()
    {
        return sprintf('https://%1$s.backlog.com/api/v2/', $this->space_id);
    }

    public function getBaseOAuthAuthorizationURL()
    {
        return sprintf('https://%1$s.backlog.com/OAuth2AccessRequest.action', $this->space_id);
    }

    public function getBaseOAuthAccessTokenURL()
    {
        return sprintf('https://%1$s.backlog.com/api/v2/oauth2/token', $this->space_id);
    }
}
