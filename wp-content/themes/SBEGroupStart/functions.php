<?php

define('DOMAIN', $_SERVER['HTTP_HOST']);

add_action( 'wp_enqueue_scripts', 'scripts' );
function scripts()
{
	wp_enqueue_script("jquery");
	// Load our main stylesheet.
	wp_enqueue_style( 'style', get_stylesheet_uri() );
}

function sbe_sites()
{
  global $wpdb;
  $set = array();
  $blogid = get_current_blog_id();

  $sites = $wpdb->get_results("SELECT * FROM sbe_blogs WHERE public = 1 and archived = 0");

  if ($sites) {
    foreach ( $sites as $site ) {
      $pref = explode(".", $site->domain);
      $pref = $pref[0];
      if ($pref == 'sbe') {
        continue;
      }
      $site->prefix = $pref;
      $site->name = get_site_title($site->blog_id);

      $set[] = $site;
    }
  }
  unset($sites);

  $reset = array();
  // Resort
  $st = 0;
  foreach ($set as $s) {
    if ($s->blog_id == $blogid) {
      $reset[] = $s;
      unset($set[$st]);
    } else {

    }
    $st++;
  }


  $reset = array_merge($reset, $set);
  unset($set);

  return $reset;
}

function get_site_title( $site = '' )
{
  global $wpdb;

  $site = ($site == '') ? : $site.'_';
  $q = "SELECT option_value FROM sbe_{$site}options WHERE option_name = 'blogname'";
  $title = $wpdb->get_var($q);

  return $title;
}

?>
