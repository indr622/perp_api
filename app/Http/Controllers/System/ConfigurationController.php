<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: ConfigurationController.php
 * Date: 2022-12-12
 */

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\System\ConfigurationModel;

class ConfigurationController extends Controller
{
    public function index()
    {
        $config = ConfigurationModel::getCache();
        $captcha_site_key = $config['CAPTCHA_SITE_KEY'];
        $identitas['nama_pt'] = $config['NAMA_PT'];

        $theme = [
            'V_SYSTEM_BAR_CSS_CLASS'            => $config['V_SYSTEM_BAR_CSS_CLASS'],
            'V_APP_BAR_NAV_ICON_CSS_CLASS'      => $config['V_APP_BAR_NAV_ICON_CSS_CLASS'],
            'V_NAVIGATION_DRAWER_CSS_CLASS'     => $config['V_NAVIGATION_DRAWER_CSS_CLASS'],
            'V_NAVIGATION_DRAWER_COLOR'         => $config['V_NAVIGATION_DRAWER_COLOR'],
            'V_LIST_ITEM_BOARD_CSS_CLASS'       => $config['V_LIST_ITEM_BOARD_CSS_CLASS'],
            'V_LIST_ITEM_BOARD_COLOR'           => $config['V_LIST_ITEM_BOARD_COLOR'],
            'V_LIST_ITEM_ACTIVE_CSS_CLASS'      => $config['V_LIST_ITEM_ACTIVE_CSS_CLASS'],
            'COLOR_DASHBOARD'                   => json_decode($config['COLOR_DASHBOARD'], true)
        ];

        return Response()->json([
            'status'            => 1,
            'pid'               => 'fetchdata',
            'captcha_site_key'  => $captcha_site_key,
            'identity'          => $identitas,
            'theme'             => $theme,
            'message'           => 'Configuration retrieved successfully.'
        ], 200);
    }
}
