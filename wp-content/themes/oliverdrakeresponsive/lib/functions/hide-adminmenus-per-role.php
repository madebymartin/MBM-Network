<?php
function remove_menus()
{
    global $menu;
    global $current_user;
    get_currentuserinfo();

    if($current_user->user_level < 10)
    {
        $restricted = array(__(''),
                            __('Media'),
                            __('Links'),
                            __('Comments'),
                            __('Appearance'),
                            __('Plugins'),
                            __('Users'),
                            __('Tools'),
                            __('Settings'),
                            __('Posts'),

        );
        end ($menu);
        while (prev($menu)){
            $value = explode(' ',$menu[key($menu)][0]);
            if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
        }// end while

    }// end if
}
add_action('admin_menu', 'remove_menus');
?>