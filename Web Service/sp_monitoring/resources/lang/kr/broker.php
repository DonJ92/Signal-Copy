<?php

return [
    'list' => [
        'title' => '브로커목록',
        'title_ico' => 'icon-wallet',

        'id' => 'ID',
        'alias_name' => '식별자명',
        'name' => '실제 브로커명',
        'register_date' => '등록날자',
        'update_date' => '갱신날자',
        
        'detail' => '상세',
    ],

    'register' => [
        'title' => '브로커등록',
        'title_ico' => 'icon-wallet',

        'id' => 'ID',
        'alias_name' => '* 식별자명',
        'name' => '* 실제 브로커명',

        'desc' => '*가 붙은 항목은 필수 입력 항목입니다.',
        'failed' => '브로커정보 등록이 실패하였습니다.',
        'success' => '브로커정보 등록이 성공하였습니다.',
    ],

    'detail' => [
        'title' => '거래구좌 상세',
        'title_ico' => 'icon-wallet',

        'id' => 'ID',
        'alias_name' => '* 식별자명',
        'name' => '* 실제 브로커명',

        'desc' => '*가 붙은 항목은 필수 입력 항목입니다.',
        'failed' => '브로커정보 갱신이 실패하였습니다.',
        'success' => '브로커정보 갱신이 성공하였습니다.',
    ],

    'delete' => [
        'success' => '브로커정보 삭제가 성공하였습니다.'
    ]
];