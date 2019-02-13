<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/23/2018
 * Time: 11:23 PM
 */

namespace App\Helper;

class MenuCreator
{
    public static function menuLister($modules)
    {
        foreach ($modules as $key => $module) {
            if (!isset($module['child'])) {
                if (!self::hasPriv($module['route'],$module['priv'])) continue;
                print '<li class="nav-item">
                <a href="' . route($module['route']) . '"><i class="' . $module['icon'] . '"></i>
                    <span data-i18n="nav.dash.main" class="menu-title">
                       ' . __('messages.menular.'.$module['name']) . '
                    </span>
                </a>
                </li>';
            } else {
                print '<li class="nav-item has-sub">
                <a href="javascript:void(0)">
                    <i class="' . $module['icon'] . '"></i>
                    <span data-i18n="nav.project.main" class="menu-title">' . $module['name'] . '</span>
                </a><ul class="menu-content">';

                foreach ($module['child'] as $keyChild => $child) {
                    if (!self::hasPriv($child['route'], $child['priv'])) continue;
                    print '<li class="nav-item">
                    <a href="' . route($child['route']) . '"><i class="' . $child['icon'] . '"></i>
                        <span data-i18n="nav.dash.main" class="menu-title">
                           ' . $child['name'] . '
                        </span>
                    </a>
                    </li>';
                }

                print '</ul></li>';
            }
        }
    }

    public static function hasPriv($module, $priv)
    {
        return auth('web')->user()->group->getModulePriv($module) >= $priv ? true : false;
    }
}
