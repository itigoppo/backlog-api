<?php

namespace Itigoppo\BacklogApi\Backlog;

use Itigoppo\BacklogApi\Connector\Connector;

class Projects
{
    protected $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    /**
     * プロジェクト情報の取得
     *
     * @param string $project_id_or_key
     * @return array
     */
    public function statuses($project_id_or_key)
    {
        return $this->connector->get(sprintf('projects/%s/statuses', $project_id_or_key));
    }

    /**
     * プロジェクト一覧の取得
     *
     * @param array $query_options
     * @return mixed|string
     */
    public function load($query_options = [])
    {
        $query_params = [
            ] + $query_options;

        return $this->connector->get('projects', [], $query_params);
    }

    /**
     * プロジェクト情報の取得
     *
     * @param string $project_id_or_key
     * @return mixed|string
     */
    public function find($project_id_or_key)
    {
        return $this->connector->get(sprintf('projects/%s', $project_id_or_key));
    }

    /**
     * プロジェクトの最近の活動の取得
     *
     * @param string $project_id_or_key
     * @param array $query_options
     * @return mixed|string
     */
    public function activities($project_id_or_key, $query_options = [])
    {
        $query_params = [
            ] + $query_options;

        return $this->connector->get(sprintf('projects/%s/activities', $project_id_or_key), [], $query_params);
    }

    /**
     * プロジェクトユーザー一覧の取得
     *
     * @param string $project_id_or_key
     * @return mixed|string
     */
    public function users($project_id_or_key)
    {
        return $this->connector->get(sprintf('projects/%s/users', $project_id_or_key));
    }

    /**
     * プロジェクト管理者一覧の取得
     *
     * @param string $project_id_or_key
     * @return mixed|string
     */
    public function administrators($project_id_or_key)
    {

        return $this->connector->get(sprintf('projects/%s/administrators', $project_id_or_key));
    }

    /**
     * 種別一覧の取得
     *
     * @param string $project_id_or_key
     * @return mixed|string
     */
    public function issueTypes($project_id_or_key)
    {
        return $this->connector->get(sprintf('projects/%s/issueTypes', $project_id_or_key));
    }

    /**
     * 種別の追加
     *
     * @param string $project_id_or_key
     * @param string $name
     * @param string $color
     * @return mixed|string
     */
    public function createIssueType($project_id_or_key, $name, $color)
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $form_params = [
            'name' => $name,
            'color' => $color,
        ];

        return $this->connector->post(
            sprintf(
                'projects/%s/issueTypes',
                $project_id_or_key
            ),
            $form_params,
            [],
            $headers
        );
    }

    /**
     * 種別情報の更新
     *
     * @param string $project_id_or_key
     * @param int $issue_type_id
     * @param array $form_options
     * @return mixed|string
     */
    public function updateIssueType($project_id_or_key, $issue_type_id, $form_options = [])
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $form_params = [
            ] + $form_options;

        return $this->connector->patch(
            sprintf(
                'projects/%s/issueTypes/%d',
                $project_id_or_key,
                $issue_type_id
            ),
            $form_params,
            [],
            $headers
        );
    }

    /**
     * 種別の削除
     *
     * @param string $project_id_or_key
     * @param int $issue_type_id
     * @param int $substitute_issue_type_id
     * @return mixed|string
     */
    public function deleteIssueType($project_id_or_key, $issue_type_id, $substitute_issue_type_id)
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $form_params = [
            'substituteIssueTypeId' => $substitute_issue_type_id,
        ];

        return $this->connector->delete(
            sprintf(
                'projects/%s/issueTypes/%d',
                $project_id_or_key,
                $issue_type_id
            ),
            $form_params,
            [],
            $headers
        );
    }

    /**
     * カテゴリー一覧の取得
     *
     * @param string $project_id_or_key
     * @return mixed|string
     */
    public function categories($project_id_or_key)
    {
        return $this->connector->get(sprintf('projects/%s/categories', $project_id_or_key));
    }

    /**
     * カテゴリーの追加
     *
     * @param string $project_id_or_key
     * @param string $name
     * @return mixed|string
     */
    public function createCategory($project_id_or_key, $name)
    {

        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $form_params = [
            'name' => $name,
        ];

        return $this->connector->post(
            sprintf(
                'projects/%s/categories',
                $project_id_or_key
            ),
            $form_params,
            [],
            $headers
        );
    }

    /**
     * カテゴリー情報の更新
     *
     * @param string $project_id_or_key
     * @param int $category_id
     * @param array $form_options
     * @return mixed|string
     */
    public function updateCategory($project_id_or_key, $category_id, $form_options = [])
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $form_params = [
            ] + $form_options;

        return $this->connector->patch(
            sprintf(
                'projects/%s/categories/%d',
                $project_id_or_key,
                $category_id
            ),
            $form_params,
            [],
            $headers
        );
    }

    /**
     * カテゴリーの削除
     *
     * @param string $project_id_or_key
     * @param int $category_id
     * @return mixed|string
     */
    public function deleteCategory($project_id_or_key, $category_id)
    {
        return $this->connector->delete(sprintf('projects/%s/categories/%d', $project_id_or_key, $category_id));
    }

    /**
     * バージョン(マイルストーン)一覧の取得
     *
     * @param string $project_id_or_key
     * @return mixed|string
     */
    public function versions($project_id_or_key)
    {
        return $this->connector->get(sprintf('projects/%s/versions', $project_id_or_key));
    }

    /**
     * バージョン(マイルストーン)の追加
     *
     * @param string $project_id_or_key
     * @param string $name
     * @param array $form_options
     * @return mixed|string
     */
    public function createVersion($project_id_or_key, $name, $form_options = [])
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $form_params = [
                'name' => $name,
            ] + $form_options;

        return $this->connector->post(sprintf('projects/%s/versions', $project_id_or_key), $form_params, [], $headers);
    }

    /**
     * バージョン(マイルストーン)情報の更新
     *
     * @param string $project_id_or_key
     * @param int $version_id
     * @param string $name
     * @param array $form_options
     * @return mixed|string
     */
    public function updateVersion($project_id_or_key, $version_id, $name, $form_options = [])
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $form_params = [
                'name' => $name,
            ] + $form_options;

        return $this->connector->patch(
            sprintf(
                'projects/%s/versions/%d',
                $project_id_or_key,
                $version_id
            ),
            $form_params,
            [],
            $headers
        );
    }

    /**
     * バージョン(マイルストーン)の削除
     *
     * @param string $project_id_or_key
     * @param int $version_id
     * @return mixed|string
     */
    public function deleteVersion($project_id_or_key, $version_id)
    {
        return $this->connector->delete(sprintf('projects/%s/versions/%d', $project_id_or_key, $version_id));
    }

    /**
     * プロジェクトの容量使用状況の取得
     *
     * @param string $project_id_or_key
     * @return mixed|string
     */
    public function diskUsage($project_id_or_key)
    {
        return $this->connector->get(sprintf('projects/%s/diskUsage', $project_id_or_key));
    }
}
