<?php
global $post, $wp_query;

$post_id = (int)$wp_query->query['ac_id'];
$ac_id = get_post_meta( $post_id, METAKEY_PREFIX.'ac_form', true );

$ptitle = get_the_title($post_id);
$purl = get_the_permalink($post_id);

if ($ac_id == '' && isset($_GET['id']) && !empty($_GET['id'])) {
  $ac_id = $_GET['id'];
} else
if($ac_id == '' && !isset($_GET['id'])){
  $ac_id = (int)get_option( 'contact_ac_id', '' );
  $ptitle = __('Főoldalra', TD);
  $purl = '/';
  $gohome = true;
}

if ($ac_id == '') {
  // Ha nincs AC form beállítva, akkor visszairányítjuk a referencia leírás oldalra
  wp_redirect($purl);
}

get_header(); ?>
<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <a class="backurl" href="<?=$purl?>"><?php echo __('vissza a(z)',TD); ?> <strong><?php echo $ptitle; ?></strong> <?=(!$gohome)?__('szolgáltatás adatlapjára',TD):''?></a>
  <div class="clearfix fusion-clearfix clr"></div>
  <?php echo do_shortcode('[activecampaign form='.$ac_id.']'); ?>
</div>
<?php get_footer();
