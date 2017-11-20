<?php

namespace Itigoppo\BacklogApi\Backlog;

use Itigoppo\BacklogApi\Connector\Connector;

class Wikis
{
    protected $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    /**
     * Wikiページ一覧の取得
     *
     * @param string $project_id_or_key
     * @return mixed|string
     */
    public function load($project_id_or_key)
    {
        $query_params = [
            'projectIdOrKey' => $project_id_or_key,
        ];

        return $this->connector->get('wikis', [], $query_params);
    }

    /**
     * Wikiページ数の取得
     *
     * @param string $project_id_or_key
     * @return mixed|string
     */
    public function count($project_id_or_key)
    {
        $query_params = [
            'projectIdOrKey' => $project_id_or_key,
        ];

        return $this->connector->get('wikis/count', [], $query_params);
    }

    /**
     * Wikiページタグ一覧の取得
     *
     * @param string $project_id_or_key
     * @return mixed|string
     */
    public function tags($project_id_or_key)
    {
        $query_params = [
            'projectIdOrKey' => $project_id_or_key,
        ];

        return $this->connector->get('wikis/tags', [], $query_params);
    }

    /**
     * Wikiページの追加
     *
     * @param int $project_id
     * @param string $name
     * @param string $content
     * @param array $form_options
     * @return mixed|string
     */
    public function create($project_id, $name, $content, $form_options = [])
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $form_params = [
                'projectId' => $project_id,
                'name' => $name,
                'content' => $content,
            ] + $form_options;

        return $this->connector->post('wikis', $form_params, [], $headers);
    }

    /**
     * Wikiページ情報の取得
     *
     * @param int $wiki_id
     * @return mixed|string
     */
    public function find($wiki_id)
    {
        return $this->connector->get(sprintf('wikis/%s', $wiki_id));
    }

    /**
     * Wikiページ情報の更新
     *
     * @param int $wiki_id
     * @param array $form_options
     * @return mixed|string
     */
    public function update($wiki_id, $form_options = [])
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $form_params = [
            ] + $form_options;

        return $this->connector->patch(sprintf('wikis/%s', $wiki_id), $form_params, [], $headers);
    }

    /**
     * Wikiページの削除
     *
     * @param int $wiki_id
     * @return mixed|string
     */
    public function delete($wiki_id)
    {
        return $this->connector->delete(sprintf('wikis/%s', $wiki_id));
    }

    /**
     * Wiki添付ファイル一覧の取得
     *
     * @param int $wiki_id
     * @return mixed|string
     */
    public function attachments($wiki_id)
    {
        return $this->connector->get(sprintf('wikis/%s/attachments', $wiki_id));
    }

    /**
     * Wikiページ更新履歴一覧の取得
     *
     * @param int $wiki_id
     * @param array $query_options
     * @return mixed|string
     */
    public function history($wiki_id, $query_options = [])
    {
        $query_params = [
            ] + $query_options;

        return $this->connector->get(sprintf('wikis/%s/history', $wiki_id), [], $query_params);
    }

    /**
     * Wikiページのスター一覧の取得
     *
     * @param int $wiki_id
     * @return mixed|string
     */
    public function stars($wiki_id)
    {
        return $this->connector->get(sprintf('wikis/%s/stars', $wiki_id));
    }
}
