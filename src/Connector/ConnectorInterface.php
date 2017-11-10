<?php

namespace Itigoppo\Backlog\Connector;

/**
 * Interface ConnectorInterface
 *
 * @package Itigoppo\Backlog\Connector
 */
interface ConnectorInterface
{
    /**
     * Get Request
     *
     * @param string $path
     * @param array $form_params
     * @param array $headers
     * @return mixed|string
     */
    public function get($path, $form_params = [], $headers = []);

    /**
     * Post Request
     *
     * @param string $path
     * @param array $form_params
     * @param array $headers
     * @return mixed|string
     */
    public function post($path, $form_params = [], $headers = []);
}
