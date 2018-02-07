<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Martin Stevens
 */

?><!doctype html>
<html>
<head>
<meta charset="UTF-8"/>
<title>Martin Stevens | Creative Soul</title>
<link rel="icon" type="image/png" href="img/favicon.png">
<meta name="theme-color" content="#2f363b">
<meta name="msapplication-navbutton-color" content="#2f363b">
<meta name="apple-mobile-web-app-status-bar-style" content="#2f363b">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- 
<meta name="name" content="Martin Stevens | Creative Soul">
<meta name="description" content="The graphic design portfolio of Aiden Guinnip. Projects include infographics, branding, type design, print design, and web design.">
<meta itemprop="name" content="Aiden Guinnip | Graphic Designer">
<meta itemprop="description" content="The graphic design portfolio of Aiden Guinnip. Projects include infographics, branding, type design, print design, and web design.">
<meta itemprop="image" content="http://aidenguinnip.com/img/ogimage.png">

<meta property="og:site_name" content="Graphic Designer + Front-end Developer" />
<meta property="og:title" content="Aiden Guinnip" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://aidenguinnip.com/" />
<meta property="og:description" content="The graphic design portfolio of Aiden Guinnip. Projects include infographics, branding, type design, print design, and web design." />
<meta property="og:image" content="http://aidenguinnip.com/img/ogimage.png" />
<meta property="fb:admins" content="100001474560250" />

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@aidenguinnip">
<meta name="twitter:creator" content="@aidenguinnip">
<meta name="twitter:title" content="Aiden Guinnip | Graphic Designer + Front-end Developer">
<meta name="twitter:description" content="The graphic design portfolio of Aiden Guinnip. Projects include infographics, branding, type design, print design, and web design.">
<meta name="twitter:image" content="http://aidenguinnip.com/img/ogimage.png">
 -->
<link type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/css/fluidbox.css" media="all" rel="stylesheet" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/css/fonts.css" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/css/animate.css" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,300,400,600,700,800">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/css/styles.css" />
<!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
 -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<script src="<?php bloginfo('stylesheet_directory') ?>/js/layzr.js"></script>



<script type="text/javascript">
$(window).scroll(function() {
	var conheight = $('.post').height();
	var startDistance = 0;
    var scrollTop = $(document).scrollTop();    
    var scrollAmount = $(window).scrollTop();
    var documentHeight = $(document).height();
    // calculate the percentage the user has scrolled down the page
    var scrollPercent = 100 * $(window).scrollTop() / ($(document).height() - $(window).height()); 
    
    if (scrollTop > 0) {
        $('.bar-long').css('width', scrollPercent +"%"  );
    } else {
        $('.bar-long').css('width', startDistance);
    }
    if (scrollPercent > 85) {
        $('.bar-long').css('background-color', "red"  );
    } else{ $('.bar-long').css('background-color', "#fff"  ); }
    console.log (scrollPercent)
});
</script>

<?php
gravity_form_enqueue_scripts( 1, true );
//wp_head();
?>
</head>


<nav id="overlay-nav" class="preventscrollonother">
	<div class="overlay-btn-wrapper"></div>
	<?php $menu_args = array(
	'theme_location'  => 'main-navigation',
	'menu'            => '',
	'container'       => false,
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => '',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
	);
	//wp_nav_menu( $menu_args ); 
	//echo do_shortcode('[gravityform id="1" title="false" description="false"]');
	echo gravity_form(1, false, false, false, '', true, 12);
	?>
</nav>

<header class="header" role="banner">
	<div class="header-container">
		<?php $siteurl = get_site_url( ); 
		echo '<a href="' . $siteurl  . '" id="logo">  <!-- class="btn1" on index.html -->';
		?>
			MS
		</a>
		<a href="#" class="toggle-nav">
            <span></span>
        </a>
	</div>
</header>


<body <?php if( is_front_page() ){echo 'data-page="work"';} ?> <?php body_class(); ?>>
	<div id="bar-full"></div>
	<div class="bar-long"></div>

	<div class="wrapper">
	  <div class="content">

	  	


