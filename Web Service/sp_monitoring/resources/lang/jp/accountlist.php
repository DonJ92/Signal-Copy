<?php

return [
    'list' => [
        'title' => '取引口座リスト管理',
        'title_ico' => 'icon-wallet',

        'id' => 'ID',
        'customer_id' => 'クライアント ID',
        'account_id' => 'MT4・MT5口座 ID',
        'broker_name' => '取引所',
        'detail' => '詳細',

        'register_date' => '登録日付',
        'update_date' => '更新日付',
    ],

    'register' => [
        'title' => '取引口座登録',
        'title_ico' => 'icon-wallet',
        'id' => 'ID',
        'customer_id' => '*　クライアント ID',
        'account_id' => '*　MT4・MT5口座 ID',
        'broker_name' => '*　取引所',

        'desc' => '*は必修入力項目です。',
        'failed' => '取引口座情報登録が失敗しました。',
        'success' => '取引口座情報登録が成功しました。',
    ],

    'detail' => [
        'title' => '取引口座詳細',
        'title_ico' => 'icon-wallet',

        'id' => 'ID',
        'customer_id' => '*　クライアント ID',
        'account_id' => '*　MT4・MT5口座 ID',
        'broker_name' => '*　取引所',

        'desc' => '*は必修入力項目です。',
        'failed' => '取引口座情報更新が失敗しました。',
        'success' => '取引口座情報更新が成功しました。',
    ],
];