<?php

return [
    'list' => [
        'title' => '거래구좌목록',
        'title_ico' => 'icon-wallet',

        'id' => 'ID',
        'customer_id' => '고객 ID',
        'account_id' => '계좌 ID',
        'broker_name' => '브로커명',
        'detail' => '상세',

        'register_date' => '등록날자',
        'update_date' => '갱신날자',
    ],

    'register' => [
        'title' => '거래구좌등록',
        'title_ico' => 'icon-wallet',
        'id' => 'ID',
        'customer_id' => '*고객 ID',
        'account_id' => '*계좌 ID',
        'broker_name' => '*브로커명',

        'desc' => '*가 붙은 항목은 필수 입력 항목입니다.',
        'failed' => '거래구좌 등록이 실패하였습니다.',
        'success' => '거래구좌 등록이 성공하였습니다.',
    ],

    'detail' => [
        'title' => '거래구좌상세',
        'title_ico' => 'icon-wallet',

        'id' => 'ID',
        'customer_id' => '*고객 ID',
        'account_id' => '*계좌 ID',
        'broker_name' => '*브로커명',

        'desc' => '*가 붙은 항목은 필수 입력 항목입니다.',
        'failed' => '거래구좌정보 갱신이 실패하였습니다.',
        'success' => '거래구좌정보 갱신이 성공하였습니다.',
    ],
];