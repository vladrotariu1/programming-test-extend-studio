<?php

$queryResults = array();

$queryResults[0]['id'] = 1;
$queryResults[0]['parent_id'] = 0;
$queryResults[0]['title'] = 'about';
$queryResults[0]['link'] = 'about.html';

$queryResults[1]['id'] = 2;
$queryResults[1]['parent_id'] = 0;
$queryResults[1]['title'] = 'products';
$queryResults[1]['link'] = 'products.html';

$queryResults[2]['id'] = 3;
$queryResults[2]['parent_id'] = 2;
$queryResults[2]['title'] = 'product1';
$queryResults[2]['link'] = 'product1.html';


$html = '';
$parentMenuIndex = 0;
$parentStack = array();
$childrenMenuList = array();

foreach ( $queryResults as $result ) 
{
    $childrenMenuList[$result['parent_id']][] = $result;
}

while ( ( $menu = each( $childrenMenuList[$parentMenuIndex] ) ) || ( $parentMenuIndex > 0 ) )
{
    if ( !empty( $menu ) )
    {
        /* 
            1) The menu contains submenus:
         store current menu index in the stack, and update current menu

        */
        if ( !empty( $childrenMenuList[$menu['value']['id']] ) )
        {
            $html .= '<li><a href="' . $menu['value']['link'] . '">' . $menu['value']['title'] . '</li>';
            $html .= '<ul>'; 
            array_push( $parentStack, $parentMenuIndex);
            $parentMenuIndex= $menu['value']['id'];
        }
        /* 
            2) The menu does not contain submenus 
        */
        else
        $html .= '<li><a href="' . $menu['value']['link'] . '">' . $menu['value']['title'] . '</li>';
    }
    /* 
        3) Current menu has no more sub-menus so we pop our stack. 
        This way we jump back to the previous parent.
    */
    else
    {
        $html .= '</ul>';
        $parentMenuIndex= array_pop( $parentStack );
    }
}

echo($html);

?>