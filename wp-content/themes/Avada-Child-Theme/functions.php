<?php
define('PROTOCOL', 'https');
define('DOMAIN', $_SERVER['HTTP_HOST']);
define('TARGETDOMAIN', DOMAIN);
define('IFROOT', str_replace(get_option('siteurl'), '//'.DOMAIN, get_stylesheet_directory_uri()));
define('DEVMODE', true);
define('IMG', IFROOT.'/images');
define('GOOGLE_API_KEY', 'AIzaSyA0Mu8_XYUGo9iXhoenj7HTPBIfS2jDU2E');
define('LANGKEY','hu');
define('FB_APP_ID', '');
define('DEFAULT_LANGUAGE', 'hu_HU');
define('TD', 'ldh');
define('CAPTCHA_SITE_KEY', '6LemSzsUAAAAAMo_zYX4_iZrkJflAmCdXqAnUJFv');
define('CAPTCHA_SECRET_KEY', '6LemSzsUAAAAAB3gw2paRrXodpkS8LsojL73_siW');

// Includes
require_once "includes/include.php";

$app_settings = new Setup_General_Settings();

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

function get_site_prefix()
{
  $d = explode(".", DOMAIN);

  switch ($d[0]) {
    case 'gastro': return 'gbc'; break;
    case 'sport': return 'sbe'; break;
    case 'consulting': return 'sbc'; break;
  }
}

function theme_enqueue_styles() {
    wp_enqueue_style( 'avada-parent-stylesheet', get_template_directory_uri() . '/style.css?' );
    wp_enqueue_script( 'google-maps', '//maps.googleapis.com/maps/api/js?sensor=false&language='.get_locale().'&region=hu&libraries=places&key='.GOOGLE_API_KEY);
    wp_enqueue_script( 'recaptcha', '//www.google.com/recaptcha/api.js');
    wp_enqueue_script('angularjs', '//cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.min.js');
    //wp_enqueue_script('ang-colorpicker', IFROOT . '/assets/vendors/angular-colorpicker/js/color-picker.min.js' );
    //wp_enqueue_script('szinvalaszto-ang', IFROOT . '/assets/js/szinvalaszto.ang.js?t=' . ( (DEVMODE === true) ? time() : '' ) );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function app_enqueue_styles()
{
  $prefix = get_site_prefix();
  wp_enqueue_style( 'app', IFROOT . '/assets/css/style-'.$prefix.'.css?t=' . ( (DEVMODE === true) ? time() : '' ) );

}
add_action( 'wp_enqueue_scripts', 'app_enqueue_styles', 100 );


function add_opengraph_doctype( $output ) {
	return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

function app_locale( $locale )
{
  /*
    $lang = explode('/', $_SERVER['REQUEST_URI']);
    if(array_pop($lang) === 'en'){
      $locale = 'en_US';
    }else{
      $locale = 'gr_GR';
    }*/
    //$locale = 'en_US';

    return $locale;
}

add_filter('locale','app_locale', 10);

function facebook_og_meta_header()
{
  global $wp_query;

  $title = get_option('blogname');
  $image = '';
  $desc  = get_option('blogdescription');
  $url   = get_option('site_url');

  echo '<meta property="fb:app_id" content="'.FB_APP_ID.'"/>'."\n";
  echo '<meta property="og:title" content="' . $title . '"/>'."\n";
  echo '<meta property="og:type" content="article"/>'."\n";
  echo '<meta property="og:url" content="' . $url . '/"/>'."\n";
  echo '<meta property="og:description" content="' . $desc . '/"/>'."\n";
  echo '<meta property="og:site_name" content="'.get_option('blogname').'"/>'."\n";
  echo '<meta property="og:image" content="' . $image . '"/>'."\n";

}
add_action( 'wp_head', 'facebook_og_meta_header', 5);

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/langs';
	load_child_theme_textdomain( 'rd', $lang );

  $ucid = ucid();

  $ucid = $_COOKIE['uid'];
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

function ucid()
{
  $ucid = $_COOKIE['ucid'];

  if (!isset($ucid)) {
    $ucid = mt_rand();
    setcookie( 'ucid', $ucid, time() + 60*60*24*365*2, "/");
  }

  return $ucid;
}


function rd_init()
{
  date_default_timezone_set('Europe/Budapest');

  create_custom_posttypes();
}
add_action('init', 'rd_init');

function create_custom_posttypes()
{
  // Programok
  $program = new PostTypeFactory( 'programok' );
	$program->set_textdomain( TD );
	$program->set_icon('tag');
	$program->set_name( 'Program', 'Programok' );
	$program->set_labels( array(
		'add_new' => 'Új %s',
		'not_found_in_trash' => 'Nincsenek %s a lomtárban.',
		'not_found' => 'Nincsenek %s a listában.',
		'add_new_item' => 'Új %s létrehozása',
	) );
  $program->add_taxonomy( 'kategoria', array(
    'rewrite' => 'program-kategoria',
    'name' => array('Program kategória', 'Program kategóriák'),
    'labels' => array(
      'menu_name' => 'Program kategóriák',
      'add_new_item' => 'Új %s',
      'search_items' => '%s keresése',
      'all_items' => '%s',
    )
  ) );
  $program->create();
  add_post_type_support( 'programok', 'excerpt' );
}


function rd_query_vars($aVars) {
  return $aVars;
}
add_filter('query_vars', 'rd_query_vars');

/**
* AJAX REQUESTS
*/
function ajax_requests()
{
  $ajax = new AjaxRequests();
  $ajax->contact_form();
  $ajax->szinvalaszto();
}
add_action( 'init', 'ajax_requests' );

// AJAX URL
function get_ajax_url( $function )
{
  return admin_url('admin-ajax.php?action='.$function);
}

function after_logo_content()
{

}
add_filter('avada_logo_append', 'after_logo_content');


/* GOOGLE ANALYTICS */
if( defined('DEVMODE') && DEVMODE === false ) {
	function ga_tracking_code () {
		?>
		<script>


		</script>
		<?
	}
	add_action('wp_footer', 'ga_tracking_code');
}

function memory_convert($size)
{
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

function admpage_szinvalaszto_konfigurator() {
	//add_menu_page( 'Ajánlat színválasztó konfigurátor', 'Színválasztó', 'manage_options', 'szinvalaszto_konfigurator', 'szinvalaszto_konfigurator' );
}
add_action( 'admin_menu', 'admpage_szinvalaszto_konfigurator' );

function szinvalaszto_konfigurator() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

  $content = (new ShortcodeTemplates('adminpage_'.__FUNCTION__))->load_template();
  echo $content;
}

function admin_external_scripts( $hook )
{
  if ( $hook != 'toplevel_page_szinvalaszto_konfigurator' ) {
    return;
  }

  wp_enqueue_style('ang-colorpicker', IFROOT . '/assets/vendors/angular-colorpicker/css/color-picker.min.css' );

  wp_enqueue_script('angularjs', '//cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.min.js');
  wp_enqueue_script('ang-colorpicker', IFROOT . '/assets/vendors/angular-colorpicker/js/color-picker.min.js' );
  wp_enqueue_script('szinvalaszto-ang', IFROOT . '/assets/js/szinvalaszto.ang.js?t=' . ( (DEVMODE === true) ? time() : '' ) );
}
add_action( 'admin_enqueue_scripts', 'admin_external_scripts' );

add_action('admin_head', 'my_custom_fonts', 999);
function my_custom_fonts() {
  echo '<style>
    .wp-picker-holder{
      position: absolute !important;
      z-index: 100 !important;
      top: 32px !important;
    }
    .wp-picker-container > a{
      height: 32px !important;
      width: 32px !important;
      border: 1px solid #f1f1f1 !important;
      display: block !important;
    }
    .avadaredux-container #avadaredux-form-wrapper .avadaredux-main .wp-picker-container{
      height: 25px !important;
      position: relative !important;
    }
    .wp-color-result{
      float:left !important;
    }
    .avadaredux-container #avadaredux-form-wrapper .avadaredux-main .avadaredux-container-color .iris-picker .iris-picker-inner > .iris-strip.iris-alpha-slider, .avadaredux-container #avadaredux-form-wrapper .avadaredux-main .avadaredux-container-color_alpha .iris-picker .iris-picker-inner > .iris-strip.iris-alpha-slider, .avadaredux-container #avadaredux-form-wrapper .avadaredux-main .avadaredux-typography-container .wp-picker-container .iris-picker .iris-picker-inner > .iris-strip.iris-alpha-slider{
      margin-left: 15px !important;
    }
    .avadaredux-container #avadaredux-form-wrapper .avadaredux-main .avadaredux-container-color input[type="text"], .avadaredux-container #avadaredux-form-wrapper .avadaredux-main .avadaredux-container-color_alpha input[type="text"], .avadaredux-container #avadaredux-form-wrapper .avadaredux-main .avadaredux-typography-container .wp-picker-container input[type="text"]{
      display: block !important;
      float: left !important;
    }
  </style>';
}
