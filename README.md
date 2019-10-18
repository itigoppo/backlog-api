# Backlog API Library for PHP
[![Build Status](https://travis-ci.org/itigoppo/backlog-api.svg?branch=master)](https://travis-ci.org/itigoppo/backlog-api)

BacklogAPIのPHPライブラリです。

- Backlog
- Backlog API version 2
    - https://developer.nulab-inc.com/ja/docs/backlog/

# Requirements
- PHP5.6+

# Installation

```bash
composer require itigoppo/backlog-api
```

# Usage

```php
$backlog = new Backlog(new ApiKeyConnector('Your Backlog Space ID', 'Your API KEY'[, string $domain = 'jp']));
```

$domain部分、お使いのスペースに合わせて変更してください。
デフォルトは「jp」です。

## 状態一覧の取得

```php
$backlog->statuses();
```

## 完了理由一覧の取得

```php
$backlog->resolutions();
```

## 優先度一覧の取得

```php
$backlog->priorities();
```

## スターの追加

```php
$backlog->addStar([array $form_options = []]);
```

リクエストパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/add-star/

## Space

### スペース情報の取得

```php
$backlog->space->info();
```

### 最近の更新の取得

```php
$backlog->space->notification();
```

### スペースのお知らせの取得

```php
$backlog->space->activities();
```

### スペースのお知らせの更新

```php
$backlog->space->putNotification(string $content_body);
```

### スペースの容量使用状況の取得

```php
$backlog->space->diskUsage();
```

### 添付ファイルの送信

```php
$multipart = [
    [
        'name' => 'file',
        'contents' => fopen('test.txt', 'r'),
        'filename' => 'file name',
        'headers' => [
            'Content-Type' => 'application/octet-stream'
        ]
    ]
];
$backlog->space->postAttachment(array $multipart);
```

### 以下未実装
- GET /api/v2/space/image
- GET /api/v2/space/attachment

## Users

### ユーザー一覧の取得

```php
$backlog->users->load();
```

### ユーザー情報の取得

```php
$backlog->users->find(int $user_id);
```

### ユーザーの追加

```php
$backlog->users->create(int $user_id, string $password, string $name, string $mail_address, int $role_type);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/add-user/

### 認証ユーザー情報の取得

```php
$backlog->users->myself();
```

### ユーザーの最近の活動の取得

```php
$backlog->users->activities(int $user_id[, array $query_params = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/get-user-recent-updates/

### ユーザーの受け取ったスター一覧の取得

```php
$backlog->users->stars(int $user_id[, array $query_params = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/get-received-star-list/

### ユーザーの受け取ったスターの数の取得

```php
$backlog->users->numberOfStars(int $user_id[, array $query_params = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/count-user-received-stars/

### 自分が最近見た課題一覧の取得

```php
$backlog->users->recentlyViewedIssues([array $query_params = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/get-list-of-recently-viewed-issues/

### 自分が最近見たプロジェクト一覧の取得

```php
$backlog->users->recentlyViewedProjects([array $query_params = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/get-list-of-recently-viewed-projects/

### 自分が最近見たWiki一覧の取得

```php
$backlog->users->recentlyViewedWikis([array $query_params = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/get-list-of-recently-viewed-wikis/

### 以下未実装
- PATCH /api/v2/users/:userId
- DELETE /api/v2/users/:userId
- GET /api/v2/users/:userId/icon

## Groups

### グループ一覧の取得

```php
$backlog->groups->load([array $query_params = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/get-list-of-groups/

### グループ情報の取得

```php
$backlog->groups->find(int $group_id);
```

### 以下未実装
- POST /api/v2/groups
- PATCH /api/v2/groups/:groupId
- DELETE /api/v2/groups/:groupId

## Projects

### プロジェクト一覧の取得

```php
$backlog->projects->load([array $query_params = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/get-project-list/

### プロジェクトの状態一覧の取得

```php
$backlog->projects->statuses(string $project_id_or_key);
```

### プロジェクト情報の取得

```php
$backlog->projects->find(string $project_id_or_key);
```

### プロジェクトの最近の活動の取得

```php
$backlog->projects->activities(string $project_id_or_key[, array $query_params = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/get-project-recent-updates/

### プロジェクトユーザー一覧の取得

```php
$backlog->projects->users(string $project_id_or_key);
```
### プロジェクト管理者一覧の取得

```php
$backlog->projects->administrators(string $project_id_or_key);
```
### 種別一覧の取得

```php
$backlog->projects->issueTypes(string $project_id_or_key);
```

### 種別の追加

```php
$backlog->projects->createIssueType(string $project_id_or_key, string $name, string $color);
```

### 種別情報の更新

```php
$backlog->projects->updateIssueType(string $project_id_or_key, int $issue_type_id[, array $form_options = []]);
```

リクエストパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/update-issue-type/

### 種別の削除

```php
$backlog->projects->deleteIssueType(string $project_id_or_key, int $issue_type_id, int $substitute_issue_type_id);
```

### カテゴリー一覧の取得

```php
$backlog->projects->categories(string $project_id_or_key);
```

### カテゴリーの追加

```php
$backlog->projects->createCategory(string $project_id_or_key, string $name);
```

### カテゴリー情報の更新

```php
$backlog->projects->updateCategory(string $project_id_or_key, int $category_id[, array $form_options = []]);
```

リクエストパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/update-category/

### カテゴリーの削除

```php
$backlog->projects->deleteCategory(string $project_id_or_key, int $category_id);
```

### バージョン(マイルストーン)一覧の取得

```php
$backlog->projects->versions(string $project_id_or_key);
```

### バージョン(マイルストーン)の追加

```php
$backlog->projects->createVersion(string $project_id_or_key, string $name[, array $form_options = []]);
```

リクエストメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/add-version-milestone/

### バージョン(マイルストーン)情報の更新

```php
$backlog->projects->updateVersion(string $project_id_or_key, int $version_id, string $name[, array $form_options = []]);
```

リクエストパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/update-version-milestone/

### バージョン(マイルストーン)の削除

```php
$backlog->projects->deleteVersion(string $project_id_or_key, int $version_id);
```

### プロジェクトの容量使用状況の取得

```php
$backlog->projects->diskUsage(string $project_id_or_key);
```

### 以下未実装
- POST /api/v2/projects
- POST /api/v2/projects/:projectIdOrKey
- DELETE /api/v2/projects/:projectIdOrKey
- GET /api/v2/projects/:projectIdOrKey/image
- POST /api/v2/projects/:projectIdOrKey/users
- DELETE /api/v2/projects/:projectIdOrKey/users
- POST /api/v2/projects/:projectIdOrKey/administrators
- DELETE /api/v2/projects/:projectIdOrKey/administrators
- GET /api/v2/projects/:projectIdOrKey/customFields
- POST /api/v2/projects/:projectIdOrKey/customFields
- PATCH /api/v2/projects/:projectIdOrKey/customFields/:id
- DELETE /api/v2/projects/:projectIdOrKey/customFields/:id
- POST /api/v2/projects/:projectIdOrKey/customFields/:id/items
- PATCH /api/v2/projects/:projectIdOrKey/customFields/:id/items/:itemId
- DELETE /api/v2/projects/:projectIdOrKey/customFields/:id/items/:itemId
- GET /api/v2/projects/:projectIdOrKey/files/metadata/:path
- GET /api/v2/projects/:projectIdOrKey/files/:sharedFileId
- GET /api/v2/projects/:projectIdOrKey/webhooks
- POST /api/v2/projects/:projectIdOrKey/webhooks
- GET /api/v2/projects/:projectIdOrKey/webhooks/:webhookId
- PATCH /api/v2/projects/:projectIdOrKey/webhooks/:webhookId
- DELETE /api/v2/projects/:projectIdOrKey/webhooks/:webhookId

## Issues

### 課題一覧の取得

```php
$backlog->issues->load([array $query_options = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/get-issue-list/

### 課題数の取得

```php
$backlog->issues->count([array $query_options = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/count-issue/

### 課題の追加

```
$backlog->issues->create(int $project_id, string $summary, int $issue_type_id, int $priority_id[, array $form_options = []]);
```

リクエストパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/add-issue/

### 課題情報の取得

```php
$backlog->issues->find(string $issues_id_or_key);
```

### 課題情報の更新

```php
$backlog->issues->update(string $issues_id_or_key[, array $form_options = []]);
```

リクエストパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/update-issue/

### 課題の削除

```php
$backlog->issues->delete(string $issues_id_or_key);
```

### 課題コメントの取得

```php
$backlog->issues->comments(string $issues_id_or_key[, array $query_options = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/get-comment-list/

### 課題コメントの追加

``` php
$backlog->issues->createComment(string $issues_id_or_key, string $content[, array $form_options = []]);
```

リクエストパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/add-comment/

### 課題コメント数の取得

```php
$backlog->issues->numberOfComments(string $issues_id_or_key);
```

### 課題コメント情報の取得

```php
$backlog->issues->findComment(string $issues_id_or_key, int $comment_id);
```

### 課題コメント情報の更新

```php
$backlog->issues->updateComment(string $issues_id_or_key, int $comment_id[, array $form_options = []]);
```

リクエストパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/update-comment/

### 課題コメントのお知らせ一覧の取得

```php
$backlog->issues->commentNotifications(string $issues_id_or_key, int $comment_id);
```

### 課題コメントにお知らせを追加

```php
$backlog->issues->createCommentNotification(string $issues_id_or_key, int $comment_id[, array $form_options = []]);
```

リクエストパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/add-comment-notification/

### 課題添付ファイル一覧の取得

```php
$backlog->issues->attachments(string $issues_id_or_key);
```

### 課題添付ファイルのダウンロード

```php
$backlog->issues->attachment(string $issues_id_or_key, string $attachment_id);
```

### 課題共有ファイル一覧の取得

```php
$backlog->issues->sharedFiles(string $issues_id_or_key);
```
### 以下未実装
- DELETE /api/v2/issues/:issueIdOrKey/attachments/:attachmentId
- POST /api/v2/issues/:issueIdOrKey/sharedFiles
- DELETE /api/v2/issues/:issueIdOrKey/sharedFiles/:id

## Wikis

### Wikiページ一覧の取得

```php
$backlog->wikis->load(string $project_id_or_key);
```

### Wikiページ数の取得

```php
$backlog->wikis->count($project_id_or_key);
```

### Wikiページタグ一覧の取得

```php
$backlog->wikis->tags($project_id_or_key);
```

### Wikiページの追加

```php
$backlog->wikis->create(int $project_id, string $name, string $content[, array $form_options = []]);
```

リクエストパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/add-wiki-page/

### Wikiページ情報の取得

```php
$backlog->wikis->find(int $wiki_id);
```

### Wikiページ情報の更新

```php
$backlog->wikis->update(int wiki_id[, array $form_options = []);
```

リクエストパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/update-wiki-page/

### Wikiページの削除

```php
$backlog->wikis->delete(int $wiki_id);
```

### Wiki添付ファイル一覧の取得

```php
$backlog->wikis->attachments(int $wiki_id);
```

### Wikiページ更新履歴一覧の取得

```php
$backlog->wikis->history(int $wiki_id[, array $query_options = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/get-wiki-page-history/

### Wikiページのスター一覧の取得

```php
$backlog->wikis->stars(int $wiki_id);
```

### 以下未実装
- POST /api/v2/wikis/:wikiId/attachments
- GET /api/v2/wikis/:wikiId/attachments/:attachmentId
- DELETE /api/v2/wikis/:wikiId/attachments/:attachmentId
- GET /api/v2/wikis/:wikiId/sharedFiles
- POST /api/v2/issues/:issueIdOrKey/sharedFiles
- DELETE /api/v2/wikis/:wikiId/sharedFiles/:id

## Notifications

### お知らせ一覧の取得

```php
$backlog->notifications->load([array $query_options = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/get-notification/

### お知らせ数の取得

```php
$backlog->notifications->count([array $query_options = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/count-notification/

### お知らせ数のリセット

```php
$backlog->notifications->markAllAsRead();
```

### お知らせの既読化

```php
$backlog->notifications->markAsRead(int $notification_id);
```

## Git

### Gitリポジトリ一覧の取得

```php
$backlog->git->repositories(string $project_id_or_key);
```

### Gitリポジトリの取得

```php
$backlog->git->findRepositories(string $project_id_or_key, string $repository_id_or_name);
```

### プルリクエスト一覧の取得

```php
$backlog->git->pullRequests(string $project_id_or_key, string $repository_id_or_name[, array $query_options = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/get-pull-request-list/

### プルリクエスト数の取得

```php
$backlog->git->numberOfPullRequests(string $project_id_or_key, string $repository_id_or_name[, array $query_options = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/get-number-of-pull-requests/

### プルリクエストの追加

```php
$backlog->git->createPullRequests(string $project_id_or_key, string $repository_id_or_name, string $summary, string $description, string $base_branch, string $merge_branch[, array $form_options = []]);
```

リクエストパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/add-pull-request/

### プルリクエストの取得

```php
$backlog->git->findPullRequest(string $project_id_or_key, string $repository_id_or_name, int $pull_request_number);
```

### プルリクエストの更新

```php
$backlog->git->updatePullRequest(string $project_id_or_key, string $repository_id_or_name, int $pull_request_number[, array $form_options = []]);
```

リクエストパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/update-pull-request/

### プルリクエストコメントの取得

```php
$backlog->git->pullRequestComments(string $project_id_or_key, string $repository_id_or_name, int $pull_request_number[, array $query_options = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/get-pull-request-comment/

### プルリクエストコメントの追加

```php
$backlog->git->createPullRequestComment(string $project_id_or_key, string $repository_id_or_name,  int $pull_request_number, string $content[, array $form_options = []]);
```

リクエストパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/add-pull-request-comment/

### プルリクエストコメント数の取得

```php
$backlog->git->numberOfPullRequestComments(string $project_id_or_key, string $repository_id_or_name, int $pull_request_number);
```

### プルリクエストコメント情報の更新

```php
$backlog->git->updatePullRequestComment(string $project_id_or_key, string $repository_id_or_name, int $pull_request_number, int $comment_id[, array $form_options = []]);
```

リクエストパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/update-pull-request-comment-information/

### プルリクエスト添付ファイル一覧の取得

```php
$backlog->git->pullRequestAttachments(string $project_id_or_key, string $repository_id_or_name, int $pull_request_number);
```

### 以下未実装
- GET /api/v2/projects/:projectIdOrKey/git/repositories/:repoIdOrName/pullRequests/:number/attachments/:attachmentId
- DELETE /api/v2/projects/:projectIdOrKey/git/repositories/:repoIdOrName/pullRequests/:number/attachments/:attachmentId

## Watchings

### ウォッチ一覧の取得

```php
$backlog->watchings->load(int $user_id[, array $query_options = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/get-watching-list/

### ウォッチ数の取得

```php
$backlog->watchings->count(int $user_id[, array $query_options = []]);
```

クエリパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/count-watching/

### ウォッチ情報の取得

```php
$backlog->watchings->find(int $watching_id);
```

### ウォッチの追加

```php
$backlog->watchings->create(string $issues_id_or_key[, array $form_options = []]);
```

リクエストパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/add-watching/

### ウォッチの更新

```php
$backlog->watchings->update(int $watching_id[, array $form_options = []]);
```

リクエストパラメータは以下参照
https://developer.nulab-inc.com/ja/docs/backlog/api/2/update-watching/

### ウォッチの削除

```php
$backlog->watchings->delete(int $watching_id);
```

### ウォッチの既読化

```php
$backlog->watchings->markAsRead(int $watching_id);
```

