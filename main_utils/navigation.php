<?php 
    function returnMenu($role){
        if ($role == 'vendor') {
            return [
                [
                    'name' => 'Dashboard',
                    'link' => '/manageMenu/dashboard.php',
                    'icon' => 'fa fa-fw fa-tachometer-alt w3-margin-right'
                ],
                [
                    'name' => 'Profile',
                    'link' => '/manageAccount/user/profile.php',
                    'icon' => 'fa fa-fw fa-user w3-margin-right'
                ],
                [
                    'name' => 'Manage Menu',
                    'link' => '/manageMenu/manage_menu.php',
                    'icon' => 'fa fa-fw fa-book-reader w3-margin-right'
                ],
                [
                    'name' => 'Manage Order',
                    'link' => '/manageMenu/manage_order.php',
                    'icon' => 'fa fa-fw fa-check w3-margin-right'
                ],
                [
                    'name' => 'Manage Kiosk',
                    'link' => '/manageMenu/manage_kiosk.php',
                    'icon' => 'fa fa-fw fa-store w3-margin-right'
                ],
            ];
        }
    }
?>