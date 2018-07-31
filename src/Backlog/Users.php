<?php

namespace Itigoppo\BacklogApi\Backlog;

use Itigoppo\BacklogApi\Connector\Connector;

class Users
{
    protected $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    /**
     * ユーザー一覧の取得
     *
     * @return mixed|string
     */
    public function load()
    {
        return $this->connector->get('users');
    }

    /**
     * ユーザー情報の取得
     *
     * @param int $user_id
     * @return mixed|string
     */
    public function find($user_id)
    {
        return $this->connector->get('users/' . $user_id);
    }

    /**
     * Add User
     *
     * @param string $user_id
     * @param string $password
     * @param string $name
     * @param string $mail_address
     * @param int $role_type
     * @return mixed|string
     *
     * @see https://developer.nulab-inc.com/docs/backlog/api/2/add-user/
     */
    public function create($user_id, $password, $name, $mail_address, $role_type = 2)
    {
        $form_params = [
            'userId' => $user_id,
            'password' => $password,
            'name' => $name,
            'mailAddress' => $mail_address,
            'roleType' => $role_type
        ];

        return $this->connector->post('users', $form_params);
    }

    /**
     * 認証ユーザー情報の取得
     *
     * @return mixed|string
     */
    public function myself()
    {
        return $this->connector->get('users/myself');
    }

    /**
     * ユーザーの最近の活動の取得
     *
     * @param int $user_id
     * @param array $query_options
     * @return mixed|string
     */
    public function activities($user_id, $query_options = [])
    {
        $query_params = [
            ] + $query_options;

        return $this->connector->get(sprintf('users/%s/activities', $user_id), [], $query_params);
    }

    /**
     * ユーザーの受け取ったスター一覧の取得
     *
     * @param int $user_id
     * @param array $query_options
     * @return mixed|string
     */
    public function stars($user_id, $query_options = [])
    {
        $query_params = [
            ] + $query_options;

        return $this->connector->get(sprintf('users/%s/stars', $user_id), [], $query_params);
    }

    /**
     * ユーザーの受け取ったスターの数の取得
     *
     * @param int $user_id
     * @param array $query_options
     * @return mixed|string
     */
    public function numberOfStars($user_id, $query_options = [])
    {
        $query_params = [
            ] + $query_options;

        return $this->connector->get(sprintf('users/%s/stars/count', $user_id), [], $query_params);
    }

    /**
     * 自分が最近見た課題一覧の取得
     *
     * @param array $query_options
     * @return mixed|string
     */
    public function recentlyViewedIssues($query_options = [])
    {
        $query_params = [
            ] + $query_options;

        return $this->connector->get('users/myself/recentlyViewedIssues', [], $query_params);
    }

    /**
     * 自分が最近見たプロジェクト一覧の取得
     *
     * @param array $query_options
     * @return mixed|string
     */
    public function recentlyViewedProjects($query_options = [])
    {
        $query_params = [
            ] + $query_options;

        return $this->connector->get('users/myself/recentlyViewedProjects', [], $query_params);
    }

    /**
     * 自分が最近見たWiki一覧の取得
     *
     * @param array $query_options
     * @return mixed|string
     */
    public function recentlyViewedWikis($query_options = [])
    {
        $query_params = [
            ] + $query_options;

        return $this->connector->get('users/myself/recentlyViewedWikis', [], $query_params);
    }
}
