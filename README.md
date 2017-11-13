# Backlog API Library for PHP
[![Build Status](https://travis-ci.org/itigoppo/BacklogAPI.svg?branch=master)](https://travis-ci.org/itigoppo/BacklogAPI)

BacklogAPIのPHPライブラリです。

- Backlog
- Backlog API version 2
    - https://developer.nulab-inc.com/ja/docs/backlog/

# Requirements
- PHP5.6+

# Installation

```bash
composer install itigoppo/BacklogAPI
```

# Usage

```php
$backlog = new Backlog(new ApiKeyConnector('Your Backlog Space ID', 'Your API KEY'));
```

例：スペース情報の取得

```php
$backlog->space();
```
