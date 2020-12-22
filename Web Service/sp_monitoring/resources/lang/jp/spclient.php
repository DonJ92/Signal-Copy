<?php

return [
    'list' => [
        'title' => '運営アカウント管理',
        'title_ico' => 'icon-user-tie',

        'id' => 'ID',
        'client_id' => 'アカウント ID',
        'customer_id' => 'クライアント ID',
        'account_id' => '取引口座',
        'vps_name' => 'VPS',
        'signal_type' => 'アカウントタイプ',
        'subclient_count' => 'アカウント数',
		'signalmaster_id' => 'サーバーアカウントID',

        'detail' => '詳細',

        'register_date' => '登録日付',
        'update_date' => '更新日付',
    ],

    'register' => [
        'title' => '運営アカウント登録',
        'title_ico' => 'icon-user-tie',

        'id' => 'ID',
        'client_id' => '*　アカウント ID',
        'account_id' => '*　取引口座',
        'vps_id' => '*VPS',
        'signal_type' => '*　アカウントタイプ',
		'signalmaster_id' => 'サーバーアカウント ID',
		'token' => '通信トークン',
        'detail' => '詳細',

        'desc' => '*は必修入力項目です。',
        'failed' => 'アカウント登録が失敗しました。',
        'success' => 'アカウント登録が成功しました。',
    ],

    'detail' => [
        'title' => '運営アカウント詳細',
        'title_ico' => 'icon-user-tie',

        'id' => 'ID',
        'client_id' => '*　アカウント ID',
        'account_id' => '*　取引口座',
        'vps_id' => '*　VPS',
        'signal_type' => '*　アカウントタイプ',
		'token' => '通信トークン',
        'detail' => '詳細',

        'desc' => '*は必修入力項目です。',
        'failed' => 'アカウント情報更新が失敗しました。',
        'success' => 'アカウント情報更新が成功しました。',

        'no_info' => '必要な情報がないです。'
    ],
];