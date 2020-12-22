<?php

return [
    'list' => [
        'title' => 'SP 말단관리',
        'title_ico' => 'icon-user-tie',

        'id' => 'ID',
        'client_id' => '말단 ID',
        'customer_id' => '고객 ID',
        'account_id' => '고객계좌',
        'vps_name' => 'VPS 정보',
        'signal_type' => '말단형태',
        'subclient_count' => '말단개수',
		'signalmaster_id' => '수신서버ID',

        'detail' => '상세',

        'register_date' => '등록날자',
        'update_date' => '갱신날자',
    ],

    'register' => [
        'title' => 'SP 말단관리',
        'title_ico' => 'icon-user-tie',

        'id' => 'ID',
        'client_id' => '*말단 ID',
        'account_id' => '*고객계좌',
        'vps_id' => '*VPS 이름',
        'signal_type' => '*말단형태',
		'signalmaster_id' => '수신서버 ID',
		'token' => '통신토큰',
        'detail' => '상세',

        'desc' => '*가 붙은 항목은 필수 입력 항목입니다.',
        'failed' => '말단등록이 실패하였습니다.',
        'success' => '말단등록이 성공하였습니다.',
    ],

    'detail' => [
        'title' => 'SP 말단관리',
        'title_ico' => 'icon-user-tie',

        'id' => 'ID',
        'client_id' => '*말단 ID',
        'account_id' => '*고객계좌',
        'vps_id' => '*VPS 이름',
        'signal_type' => '*말단형태',
		'token' => '통신토큰',
        'detail' => '상세',

        'desc' => '*가 붙은 항목은 필수 입력 항목입니다.',
        'failed' => '말단정보 갱신이 실패하였습니다.',
        'success' => '말단정보 갱신이 성공하였습니다.',

        'no_info' => '필요한 정보를 찾을수 없습니다.'
    ],
];