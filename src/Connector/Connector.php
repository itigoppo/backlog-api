<?php

namespace Itigoppo\Backlog\Connector;

abstract class Connector implements ConnectorInterface
{
    const API_URL = 'https://%s.backlog.jp/api/v2/';
}
