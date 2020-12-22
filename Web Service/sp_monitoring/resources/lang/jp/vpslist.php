<?php

return [
    'list' => [
        'title' => 'VPSリスト管理',
        'title_ico' => 'icon-server',

        'id' => 'ID',
        'vps_name' => 'VPS名',
        'customer_id' => 'クライアント ID',
        'vps_ip' => 'VPS IP',
        'detail' => '詳細',

        'register_date' => '登録日付',
        'update_date' => '更新日付',
    ],

    'register' => [
        'title' => 'VPS登録',
        'title_ico' => 'icon-server',

        'vps_name' => '*　VPS名',
        'customer_id' => '*　クライアント ID',
        'vps_ip' => '*　VPS IP',
        'detail' => '詳細',

        'desc' => '*は必修入力項目です。',
        'failed' => 'VPS情報登録が失敗しました。',
        'success' => 'VPS情報登録が成功しました。',
    ],

    'detail' => [
        'title' => 'VPS詳細',
        'title_ico' => 'icon-wallet',

        'vps_name' => '*　VPS名',
        'customer_id' => '*　クライアントID',
        'vps_ip' => '*　VPS IP',

        'desc' => '*は必修入力項目です。',
        'failed' => 'VPS情報更新が失敗しました。',
        'success' => 'VPS情報更新が成功しました。',
    ],
];