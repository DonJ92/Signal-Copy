<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getGender($gender)
    {
        if ($gender == MALE)
            return trans('common.gender.male');
        else if ($gender == FEMALE)
            return trans('common.gender.female');
        else
            return '';
    }

    protected function getDevelopingState($state)
    {
        if ($state == NO_DEVELOPED)
            return trans('common.develop_state.no_developed');
        else if ($state == DEVELOPING)
            return trans('common.develop_state.developing');
        else if ($state == DEVELOPED)
            return trans('common.develop_state.developed');
        else if ($state == SITE_UPDATE)
            return trans('common.develop_state.site_update');
        else
            return '';
    }
}
