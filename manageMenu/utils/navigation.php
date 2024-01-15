<?php
include('../config/server.php');
$server_obj = new ConfigServer();

$server_host = $server_obj->getServerHost();
$menu_url = [
    [
        'name' => 'Dashboard',
        'link' => "$server_host/manageMenu/dashboard.php",
        'icon' => 'fa fa-fw fa-tachometer-alt w3-margin-right'
    ],
    [
        'name' => 'Profile',
        'link' => "$server_host/manageAccount/user/profile.php",
        'icon' => 'fa fa-fw fa-user w3-margin-right'
    ],
    [
        'name' => 'Manage Menu',
        'link' => "$server_host/manageMenu/manage_menu.php",
        'icon' => 'fa fa-fw fa-book-reader w3-margin-right'
    ],
    [
        'name' => 'Manage Order',
        'link' => "$server_host/manageMenu/manage_order.php",
        'icon' => 'fa fa-fw fa-check w3-margin-right'
    ],
    [
        'name' => 'Manage Kiosk',
        'link' => "$server_host/manageMenu/manage_kiosk.php",
        'icon' => 'fa fa-fw fa-store w3-margin-right'
    ],
]

?>