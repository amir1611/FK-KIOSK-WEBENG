<?php
$localhost = "http://" . $_SERVER['HTTP_HOST'];

$menu_url = [
    [
        'name' => 'Dashboard',
        'link' => 'dashboard.php',
        'icon' => 'fa fa-fw fa-tachometer-alt w3-margin-right'
    ],
    [
        'name' => 'Profile',
        'link' => '#',
        'icon' => 'fa fa-fw fa-user w3-margin-right'
    ],
    [
        'name' => 'Manage Menu',
        'link' => 'manage_menu.php',
        'icon' => 'fa fa-fw fa-book-reader w3-margin-right'
    ],
    [
        'name' => 'Manage Order',
        'link' => 'manage_order.php',
        'icon' => 'fa fa-fw fa-check w3-margin-right'
    ],
    [
        'name' => 'Manage Kiosk',
        'link' => 'manage_kiosk.php',
        'icon' => 'fa fa-fw fa-store w3-margin-right'
    ],
]

?>