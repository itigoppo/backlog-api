<?php

namespace Itigoppo\BacklogApi\Connector;

abstract class Connector implements ConnectorInterface
{
    const API_URL = 'https://%s.backlog.jp/api/v2/';
}
