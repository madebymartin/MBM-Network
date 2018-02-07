<?php
function childtheme_maintenance_notice() { ?>
    <style>
        .maintenance { margin: 1em 2em; padding: .5em; box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); }
        .maintenance p { margin: 0; padding: 0; width: 100%; }
        .maintenance p:before { content: "This site is currently undergoing some major revisions (new custom theme), so some stuff may look funny. :)" }
    </style>
    <div class="maintenance"><p></p></div>
<?php }
add_action ('thematic_belowheader', 'childtheme_maintenance_notice');
?>