<?php

namespace Itigoppo\BacklogApi\Backlog;

use Itigoppo\BacklogApi\Connector\Connector;

class Notifications
{
    protected $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    /**
     * お知らせ一覧の取得
     *
     * @param array $query_options
     * @return mixed|string
     */
    public function load($query_options = [])
    {
        $query_params = [
            ] + $query_options;

        return $this->connector->get('notifications', [], $query_params);
    }

    /**
     * お知らせ数の取得
     *
     * @param array $query_options
     * @return mixed|string
     */
    public function count($query_options = [])
    {
        $query_params = [
            ] + $query_options;

        return $this->connector->get('notifications/count', [], $query_params);
    }

    /**
     * お知らせ数のリセット
     *
     * @return mixed|string
     */
    public function markAllAsRead()
    {
        return $this->connector->post('notifications/markAsRead');
    }

    /**
     * お知らせの既読化
     *
     * @param int $notification_id
     * @return mixed|string
     */
    public function markAsRead($notification_id)
    {
        return $this->connector->post(sprintf('notifications/%d/markAsRead', $notification_id));
    }
}
