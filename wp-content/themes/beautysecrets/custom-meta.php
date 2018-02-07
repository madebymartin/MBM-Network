01	<?php
02	 
03	// Hook into WordPress
04	add_action( 'admin_init', 'add_custom_metabox' );
05	add_action( 'save_post', 'save_custom_url' );
06	 
07	/**
08	 * Add meta box
09	 */
10	function add_custom_metabox() {
11	    add_meta_box( 'custom-metabox', __( 'URL &amp; Description' ), 'url_custom_metabox', 'product', 'side', 'high' );
12	}
13	 
14	/**
15	 * Display the metabox
16	 */
17	function url_custom_metabox() {
18	    global $post;
19	    $urllink = get_post_meta( $post->ID, 'urllink', true );
20	    $urldesc = get_post_meta( $post->ID, 'urldesc', true );
21	 
22	    if ( !preg_match( "/http(s?):\/\//", $urllink )) {
23	        $errors = 'Url not valid';
24	        $urllink = 'http://';
25	    }
26	 
27	    // output invlid url message and add the http:// to the input field
28	    if( $errors ) { echo $errors; } ?>
29	 
30	    <p><label for="siteurl">Url:<br />
31	        <input id="siteurl" size="37" name="siteurl" value="<?php if( $urllink ) { echo $urllink; } ?>" /></label></p>
32	    <p><label for="urldesc">Description:<br />
33	        <textarea id="urldesc" name="urldesc" cols="45" rows="4"><?php if( $urldesc ) { echo $urldesc; } ?></textarea></label></p>
34	<?php
35	}
36	 
37	/**
38	 * Process the custom metabox fields
39	 */
40	function save_custom_url( $post_id ) {
41	    global $post;  
42	 
43	    if( $_POST ) {
44	        update_post_meta( $post->ID, 'urllink', $_POST['siteurl'] );
45	        update_post_meta( $post->ID, 'urldesc', $_POST['urldesc'] );
46	    }
47	}
48	 
49	/**
50	 * Get and return the values for the URL and description
51	 */
52	function get_url_desc_box() {
53	    global $post;
54	    $urllink = get_post_meta( $post->ID, 'urllink', true );
55	    $urldesc = get_post_meta( $post->ID, 'urldesc', true );
56	 
57	    return array( $urllink, $urldesc );
58	}
59	?>