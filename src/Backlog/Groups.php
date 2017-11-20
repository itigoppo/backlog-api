<?php

namespace Itigoppo\BacklogApi\Backlog;

use Itigoppo\BacklogApi\Connector\Connector;

class Groups
{
    protected $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    /**
     * グループ一覧の取得
     *
     * @param array $query_options
     * @return mixed|string
     */
    public function load($query_options = [])
    {
        $query_params = [
            ] + $query_options;

        return $this->connector->get('groups', [], $query_params);
    }

    /**
     * グループ情報の取得
     *
     * @param int $group_id
     * @return mixed|string
     */
    public function find($group_id)
    {
        return $this->connector->get(sprintf('groups/%d', $group_id));
    }
}
