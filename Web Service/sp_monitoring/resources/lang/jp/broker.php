<?php

return [
    'list' => [
        'title' => '取引所リスト管理',
        'title_ico' => 'icon-office',

        'id' => 'ID',
        'alias_name' => '取引所識別名',
        'name' => '取引所名',
        'register_date' => '登録日付',
        'update_date' => '更新日付',
        
        'detail' => '詳細',
    ],

    'register' => [
        'title' => '取引所登録',
        'title_ico' => 'icon-office',

        'id' => 'ID',
        'alias_name' => '* 取引所識別名',
        'name' => '* 取引所名',

        'desc' => '*は必修入力項目です。',
        'failed' => '取引所情報登録が失敗しました。',
        'success' => '取引所情報登録が成功しました。',
    ],

    'detail' => [
        'title' => '取引所情報詳細',
        'title_ico' => 'icon-office',

        'id' => 'ID',
        'alias_name' => '* 取引所識別名',
        'name' => '* 取引所名',

        'desc' => '*は必修入力項目です。',
        'failed' => '取引所情報更新が失敗しました。',
        'success' => '取引所情報更新が成功しました。',
    ],

    'delete' => [
        'success' => '取引所情報が削除されました。'
    ]
];