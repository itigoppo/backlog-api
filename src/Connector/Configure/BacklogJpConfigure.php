<?php

namespace Itigoppo\BacklogApi\Connector\Configure;

class BacklogJpConfigure extends Configure
{
    public function getApiBaseURL()
    {
        return sprintf('https://%1$s.backlog.jp/api/v2/', $this->space_id);
    }

    public function getOAuthAuthorizationURL()
    {
        return sprintf('https://%1$s.backlog.jp/OAuth2AccessRequest.action', $this->space_id);
    }

    public function getOAuthAccessTokenURL()
    {
        return sprintf('https://%1$s.backlog.jp/api/v2/oauth2/token', $this->space_id);
    }
}
