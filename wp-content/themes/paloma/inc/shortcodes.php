<?php

/*** File for creating and adding shortcodes */

/* Large button */
function stnsvn_large_button($atts){
   extract(shortcode_atts(array(
    'url' 		=> 'http://#',
	  'button_text'	=> __('Button Text', 'paloma'),
    'align' => __('center', 'paloma') //Set default button alignment to center
   ), $atts));

   $button_string = '<div class="paloma-button large-button" style="text-align:'.$align.'">
                     <a href="'.$url.'">
                     <h4>'.$button_text.'</h4>
                       </a>
                       </div>';
   return $button_string;
}

function stnsvn_large_button_light($atts){
   extract(shortcode_atts(array(
    'url'     => 'http://#',
    'button_text' => __('Button Text', 'paloma'),
    'align' => __('center', 'paloma') //Set default button alignment to center
   ), $atts));

   $button_string = '<div class="paloma-button large-button light-button" style="text-align:'.$align.'">
                     <a href="'.$url.'">
                     <h4>'.$button_text.'</h4>
                       </a>
                       </div>';
   return $button_string;
}

/*to-delete ?*/
function stnsvn_small_button($atts){
   extract(shortcode_atts(array(
      'url' 		=> 'http://#',
	  'button_text'	=> __('Button Text', 'paloma')
   ), $atts));

   $button_string = '<div class="paloma-button small-button">
                     <a href="'.$url.'">
                     <h5>'.$button_text.'</h5>
                       </a>
                       </div>';
   return $button_string;
}

function stnsvn_accent_small(){
   return paloma_accent_small();
}

function stnsvn_accent_large(){
    ob_start();
    get_template_part( 'template-parts/content', 'accent' );
    $output = ob_get_clean();
    return $output;
}

function stnsvn_social() {
  
    ob_start();
    get_template_part( 'template-parts/content', 'social' );
    $output = ob_get_clean();
    return $output;
}

function stnsvn_col_2($atts, $content = null) {
  
   $col_string = '<div class="paloma-column paloma-col-2"><p>'.do_shortcode($content).'</p></div>';
   return $col_string;
}

function stnsvn_col_3($atts, $content = null) {
  
   $col_string = '<div class="paloma-column paloma-col-3"><p>'.do_shortcode($content).'</p></div>';
   return $col_string;
}

function stnsvn_col_4($atts, $content = null) {
  
   $col_string = '<div class="paloma-column paloma-col-4"><p>'.do_shortcode($content).'</p></div>';
   return $col_string;
}

function stnsvn_col_row($atts, $content = null) {
     $col_string = '<div class="paloma-column-row clear">'.do_shortcode($content).'</div>';
   return $col_string;
}

function stnsvn_spacer($atts){
   extract(shortcode_atts(array(
      'height'     => '20px'
   ), $atts));

   $spacer_string = '<div class="stnsvn-spacer" style="height:'.$height.';"></div>';
   return $spacer_string;
}

function stnsvn_register_shortcodes(){
   add_shortcode('stnsvn-button-large', 'stnsvn_large_button');
   add_shortcode('stnsvn-button-large-light', 'stnsvn_large_button_light');
   add_shortcode('stnsvn-button-small', 'stnsvn_small_button');
   add_shortcode('stnsvn-social', 'stnsvn_social');
   add_shortcode('stnsvn-col-2', 'stnsvn_col_2');
   add_shortcode('stnsvn-col-3', 'stnsvn_col_3');
   add_shortcode('stnsvn-col-4', 'stnsvn_col_4');
   add_shortcode('stnsvn-col-row', 'stnsvn_col_row');
   add_shortcode('stnsvn-spacer', 'stnsvn_spacer');
   add_shortcode('stnsvn-accent-small', 'stnsvn_accent_small');
   add_shortcode('stnsvn-accent-large', 'stnsvn_accent_large');
}
add_action( 'init', 'stnsvn_register_shortcodes');



?>