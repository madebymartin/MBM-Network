<?php
//replace the standard doctype declaration and html tag opening...
function html5_create_doctype($content) {
 $content = "<!DOCTYPE html>";
 $content .= "\n";
 $content .= "<html";
 return $content;
}
add_filter('thematic_create_doctype', 'html5_create_doctype');
 
//replace the lang attribute in the opening <html> tag...
function html5_language_attributes($content) {
	$content = "lang=\"en\"";
	return $content;
}
add_filter('language_attributes', 'html5_language_attributes');
 
//replace the <head> tag opening to remove the now defunct profile attribute and add the <meta charset="utf-8"> tag...
function html5_head($content) {
 $content = "<head>";
 $content .= "\n";
 $content .= "<meta charset=\"utf-8\">";
 $content .= "\n";
 return $content;
}
add_filter('thematic_head_profile', 'html5_head');
 
//remove the now defunct <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> tag...
function html5_create_charset($content) {
 $content = "";
 return $content;
}
add_filter('thematic_create_contenttype', 'html5_create_charset');
?>