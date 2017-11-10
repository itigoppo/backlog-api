<?php

namespace Itigoppo\Backlog;

use Itigoppo\Backlog\Connector\Connector;

class Backlog
{
    /** @var Connector */
    protected $connector;

    public function __construct($connector)
    {
        $this->connector = $connector;
    }

    /**
     * スペース情報の取得
     *
     * @return mixed|string
     */
    public function space()
    {
        return $this->connector->get('space');
    }

    /**
     * 最近の更新の取得
     *
     * @param null|int $activity_type_id
     * @param null|int $min_id
     * @param null|int $max_id
     * @param int $count
     * @param string $order
     * @return mixed|string
     * @internal param array $params
     */
    public function activities($activity_type_id = null, $min_id = null, $max_id = null, $count = 20, $order = 'desc')
    {
        $params = [
            'activityTypeId' => $activity_type_id,
            'minId' => $min_id,
            'maxId' => $max_id,
            'count' => $count,
            'order' => $order,
        ];

        return $this->connector->get('space/activities', $params);
    }

    /**
     * ユーザー一覧の取得
     *
     * @return mixed|string
     */
    public function users()
    {
        return $this->connector->get('users');
    }

    /**
     * 優先度一覧の取得
     *
     * @return mixed|string
     */
    public function priorities()
    {
        return $this->connector->get('priorities');
    }

    /**
     * プロジェクトの一覧取得
     *
     * @param null|bool $archived
     * @param bool $all
     * @return mixed|string
     */
    public function projects($archived = null, $all = false)
    {
        $params = [
            'archived' => $archived,
            'all' => $all,
        ];

        return $this->connector->get('projects', [], $params);
    }

    /**
     * 種別一覧の取得
     *
     * @param int $project_id
     * @return mixed|string
     */
    public function issueTypes($project_id)
    {
        return $this->connector->get('projects/' . $project_id . '/issueTypes');
    }

    /**
     * 課題登録
     *
     * @param int $project_id
     * @param string $summary
     * @param int $issue_type_id
     * @param int $priority_id
     * @param array $options
     * @return mixed|string
     */
    public function issues($project_id, $summary, $issue_type_id, $priority_id, $options = [])
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $form_params = [
                'projectId' => $project_id,
                'summary' => $summary,
                'issueTypeId' => $issue_type_id,
                'priorityId' => $priority_id,
            ] + $options;

        return $this->connector->post('issues', $headers, $form_params);
    }
}
