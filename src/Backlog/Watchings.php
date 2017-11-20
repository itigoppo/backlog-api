<?php

namespace Itigoppo\BacklogApi\Backlog;

use Itigoppo\BacklogApi\Connector\Connector;

class Watchings
{
    protected $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    /**
     * ウォッチ一覧の取得
     *
     * @param int $user_id
     * @param array $query_options
     * @return mixed|string
     */
    public function load($user_id, $query_options = [])
    {
        $query_params = [
            ] + $query_options;

        return $this->connector->get(sprintf('users/%d/watchings', $user_id), [], $query_params);
    }

    /**
     * ウォッチ数の取得
     *
     * @param int $user_id
     * @param array $query_options
     * @return mixed|string
     */
    public function count($user_id, $query_options = [])
    {
        $query_params = [
            ] + $query_options;

        return $this->connector->get(sprintf('users/%d/watchings/count', $user_id), [], $query_params);
    }

    /**
     * ウォッチ情報の取得
     *
     * @param int $watching_id
     * @return mixed|string
     */
    public function find($watching_id)
    {
        return $this->connector->get(sprintf('watchings/%d', $watching_id));
    }

    /**
     * ウォッチの追加
     *
     * @param string $issues_id_or_key
     * @param array $form_options
     * @return mixed|string
     */
    public function create($issues_id_or_key, $form_options = [])
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $form_params = [
                'issueIdOrKey' => $issues_id_or_key,
            ] + $form_options;

        return $this->connector->post('watchings', $form_params, [], $headers);
    }

    /**
     * ウォッチの更新
     *
     * @param int $watching_id
     * @param array $form_options
     * @return mixed|string
     */
    public function update($watching_id, $form_options = [])
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $form_params = [
            ] + $form_options;

        return $this->connector->patch(sprintf('watchings/%d', $watching_id), $form_params, [], $headers);
    }

    /**
     * ウォッチの削除
     *
     * @param int $watching_id
     * @return mixed|string
     */
    public function delete($watching_id)
    {
        return $this->connector->delete(sprintf('watchings/%d', $watching_id));
    }

    /**
     * ウォッチの既読化
     *
     * @param int $watching_id
     * @return mixed|string
     */
    public function markAsRead($watching_id)
    {
        return $this->connector->post(sprintf('watchings/%d/markAsRead', $watching_id));
    }
}
