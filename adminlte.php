<?php

/*
    Cari file adminlte.php di folder vendor folder laravelmu (kalau aku di ipos\vendor\jeroennoten\laravel-adminlte\config\adminlte.php) (harusnya punyamu sama juga), lalu copy paste semua ini ke sana
*/

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'IPOS',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => 'IPOS',

    'logo_mini' => 'POS',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'yellow',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'MENU UTAMA',
        [
            'text'        => 'Pemesanan',
            'icon'        => 'book',
            'submenu'     => [
                [
                    'text'        => 'Pesan Baru',
                    'url'         => 'pemesanan',
                    'icon'        => 'pencil',
                ],
                [
                    'text'        => 'Historis Pemesanan',
                    'url'         => 'pemesanan/status',
                    'icon'        => 'bell',
                ],
                [
                    'text'        => 'Pesanan Kedai',
                    'url'         => 'pemesanan/toko',
                    'icon'        => 'balance-scale',
                    'can'         => 'is_seller',
                ],
            ],
        ],
        [
            'text'        => 'Menu',
            'icon'        => 'group',
            'submenu'     => [
                [
                    'text'        => 'Lihat Menu',
                    'url'         => 'makanan',
                    'icon'        => 'coffee',
                ],
                [
                    'text'        => 'Buat Menu Baru',
                    'url'         => 'makanan/buat',
                    'icon'        => 'pencil',
                    'can'         => 'is_seller',
                ],
                [
                    'text'        => 'Ulasan',
                    'url'         => 'ulasan',
                    'icon'        => 'thumbs-up',
                ],
            ],
        ],
        [
            'text'        => 'Kedai',
            'icon'        => 'bank',
            'submenu'     => [
                [
                    'text'        => 'Lihat Kedai',
                    'url'         => 'toko/lihat',
                    'icon'        => 'briefcase',
                ],
                [
                    'text'        => 'Detail Kedai',
                    'url'         => 'toko/detail',
                    'icon'        => 'pie-chart',
                    'can'         => 'is_seller',
                ],
                [
                    'text'        => 'Buat Kedai Baru',
                    'url'         => 'toko/buat',
                    'icon'        => 'pencil',
                    'can'         => 'is_seller',
                ],
                [
                    'text'        => 'Daftar pada Kedai',
                    'url'         => 'toko/daftar',
                    'icon'        => 'child',
                    'can'         => 'is_seller',
                ],
            ],
        ],
        [
            'text'        => 'Kasir',
            'url'         => 'pemesanan/kasir',
            'icon'        => 'bank',
            'can'         => 'is_cashier',
        ],
        [
            'text'        => 'Tutorial',
            'url'         => 'home',
            'icon'        => 'book',
        ],
        'PENGATURAN AKUN',
        [
            'text' => 'Profil',
            'url'  => 'profile',
            'icon' => 'user',
        ],
        // [
        //     'text' => 'Ubah Password',
        //     'url'  => 'profile/password',
        //     'icon' => 'lock',
        // ],
        // [
        //     'text' => 'User',
        //     'url'  => 'admin/user',
        //     'can'  => 'manage-user',
        // ],
        // [
        //     'text'        => 'Pages',
        //     'url'         => 'admin/pages',
        //     'icon'        => 'file',
        //     'label'       => 4,
        //     'label_color' => 'success',
        // ],
        // [
        //     'text'    => 'Multilevel',
        //     'icon'    => 'share',
        //     'submenu' => [
        //         [
        //             'text' => 'Level One',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text'    => 'Level One',
        //             'url'     => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'Level Two',
        //                     'url'  => '#',
        //                 ],
        //                 [
        //                     'text'    => 'Level Two',
        //                     'url'     => '#',
        //                     'submenu' => [
        //                         [
        //                             'text' => 'Level Three',
        //                             'url'  => '#',
        //                         ],
        //                         [
        //                             'text' => 'Level Three',
        //                             'url'  => '#',
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //         ],
        //         [
        //             'text' => 'Level One',
        //             'url'  => '#',
        //         ],
        //     ],
        // ],
        // 'LABELS',
        // [
        //     'text'       => 'Important',
        //     'icon_color' => 'red',
        // ],
        // [
        //     'text'       => 'Warning',
        //     'icon_color' => 'yellow',
        // ],
        // [
        //     'text'       => 'Information',
        //     'icon_color' => 'aqua',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
    ],
];
