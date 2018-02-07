<?php   
function dequeue_styles(){
wp_dequeue_style('jigoshop_frontend_styles');
}  
add_action( 'wp_enqueue_scripts', 'dequeue_styles', 99 );
?> 