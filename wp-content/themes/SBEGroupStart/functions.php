<?php

add_action( 'wp_enqueue_scripts', 'scripts' );
function scripts()
{
	wp_enqueue_script("jquery");
	// Load our main stylesheet.
	wp_enqueue_style( 'style', get_stylesheet_uri() );
}

?>
