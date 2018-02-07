<?php
// looad google analytics - optimized version http://mathiasbynens.be/notes/async-analytics-snippet
function childtheme_google_analytics() { ?>
<script>var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.src='//www.google-analytics.com/ga.js';s.parentNode.insertBefore(g,s)}(document,'script'))</script>
<?php }
add_action('wp_head', 'childtheme_google_analytics');
?>
