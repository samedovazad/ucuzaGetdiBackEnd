<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/23/2018
 * Time: 11:02 PM
 */

namespace App\Helper;

class Standarts
{
    public static $adminModules = [

        'home'    => ['name' => 'home', 'icon' => 'icon-home3', 'route' => 'admin.home', 'priv' => self::PRIV_CAN_SEE],
        'users'   => ['name' => 'user', 'icon' => 'icon-person-stalker', 'route' => 'admin.users', 'priv' => self::PRIV_CAN_SEE],
        'auction' => ['name' => 'auction', 'icon' => 'icon-grid2', 'route' => 'admin.auction', 'priv' => self::PRIV_CAN_SEE],
        'msk' => ['name' => 'MSK', 'icon' => 'icon-android-settings', 'child' => [
            'category' => ['name' => 'Kateqoriyalar', 'icon' => 'icon-ios-list', 'route' => 'admin.category', 'priv' => self::PRIV_CAN_SEE],
            'priv' => ['name' => 'İstifadəçi hüquqları', 'icon' => 'icon-ios-unlocked', 'route' => 'admin.priv', 'priv' => self::PRIV_CAN_SEE],
            'country_city' => ['name' => 'Ölkələr və Şəhərlər', 'icon' => 'icon-flag3', 'route' => 'admin.country_city', 'priv' => self::PRIV_CAN_SEE],
            'auction_status' => ['name' => 'Hərrac statusları', 'icon' => 'icon-stats-bars2', 'route' => 'admin.auction_status', 'priv' => self::PRIV_CAN_SEE],
            'user_status' => ['name' => 'İstifadəçi statusları', 'icon' => 'icon-person-stalker', 'route' => 'admin.user_status', 'priv' => self::PRIV_CAN_SEE],
            'sliders' => ['name' => 'Sliders', 'icon' => 'icon-images', 'route' => 'admin.slider', 'priv' => self::PRIV_CAN_SEE],
        ]
        ],
        'documentation' => ['name' => 'documentation', 'icon' => 'icon-ios-bookmarks-outline', 'route' => 'admin.doc', 'priv' => self::PRIV_CAN_SEE],
    ];


    const PRIV_CAN_SEE = 2;
    const PRIV_CAN_EDIT = 3;


    const fileDirectories = [
        'avatarFiles' => 'assets/admin/images/avatars/'
    ];


    const user_types = [
        'ADMIN' => 'admin',
        'USER' => 'user'
    ];

    const AuctionStatuses =[
        'APPROVED' => 1,
        'NONAPPROVED' => 2,
        'REJECTED' => 3
    ];

    public static function locale()
    {
        return request()->cookie('locale', config('app.locale'));
    }

}
