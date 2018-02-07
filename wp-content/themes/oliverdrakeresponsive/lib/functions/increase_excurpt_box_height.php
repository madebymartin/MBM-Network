<?php
// increase exceprt box height
add_action('admin_head', 'excerpt_textarea_height');
function excerpt_textarea_height() {
    echo'
    <style type="text/css">
        #excerpt{ height:500px; }
    </style>
    ';
}
?>