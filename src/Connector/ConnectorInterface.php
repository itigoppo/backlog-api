<?php

namespace Itigoppo\BacklogApi\Connector;

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
     * @param array $query_params
     * @param array $headers
     * @return mixed|string
     */
    public function get($path, $form_params = [], $query_params = [], $headers = []);

    /**
     * Post Request
     *
     * @param string $path
     * @param array $form_params
     * @param array $query_params
     * @param array $headers
     * @return mixed|string
     */
    public function post($path, $form_params = [], $query_params = [], $headers = []);

    /**
     * Put Request
     *
     * @param string $path
     * @param array $form_params
     * @param array $query_params
     * @param array $headers
     * @return mixed|string
     */
    public function put($path, $form_params = [], $query_params = [], $headers = []);

    /**
     * Patch Request
     *
     * @param string $path
     * @param array $form_params
     * @param array $query_params
     * @param array $headers
     * @return mixed|string
     */
    public function patch($path, $form_params = [], $query_params = [], $headers = []);

    /**
     * Delete Request
     *
     * @param string $path
     * @param array $form_params
     * @param array $query_params
     * @param array $headers
     * @return mixed|string
     */
    public function delete($path, $form_params = [], $query_params = [], $headers = []);

    /**
     * Multipart Post Request
     *
     * @param string $path
     * @param array $multipart
     * @param array $query_params
     * @param array $headers
     * @return mixed
     */
    public function postFile($path, $multipart, $query_params = [], $headers = []);

    /**
     * Get Request for File
     *
     * @param string $path
     * @param array $form_params
     * @param array $query_params
     * @param array $headers
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getFile($path, $form_params = [], $query_params = [], $headers = []);
}
