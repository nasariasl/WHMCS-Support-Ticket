<?php

use WHMCS\View\Menu\Item as MenuItem;

// add_hook('ClientAreaPrimaryNavbar', 1, function (MenuItem $primaryNavbar)
// {
//     $primaryNavbar->addChild('Menu Name')
//         ->setUri('https://www.example.com/')
//         ->setOrder(70);
// });

add_hook('ClientAreaPrimaryNavbar', 1, function (MenuItem $primaryNavbar)
{
    // $navItem = $primaryNavbar->getChild('Support');
    // if (is_null($navItem)) {
    //     return;
    // }

    // $navItem = $navItem->getChild('Tickets');
    // if (is_null($navItem)) {
    //     return;
    // }

    //$navItem->setUri('https://www.example.com/3rdpartyblogsystem');

    $navItem_open_tk = $primaryNavbar->getChild('Open Ticket');
        if (is_null($navItem_open_tk)) {
            return;
        }
    
    
        $navItem_open_tk->setUri('index.php?m=support_ticket');
    
});

// add_hook('ClientAreaPrimaryNavbar', 1, function (MenuItem $primaryNavbar)
// {
//     $navItem = $primaryNavbar->getChild('Open Ticket');
//     if (is_null($navItem)) {
//         return;
//     }


//     $navItem->setUri('https://www.example.com/3rdpartyblogsystem');

// });