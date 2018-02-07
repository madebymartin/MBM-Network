<?php
//custom admin stylesheet
add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
    body, td, textarea, input, select {
      font-family: "verdana", arial, sans-serif;
		font-size:10px;
		
}
#adminmenu a.menu-top, #adminmenu .wp-submenu-head {
    font-size: 11px;
}
  </style>';
}
?>