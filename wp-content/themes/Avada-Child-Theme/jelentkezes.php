<?php
global $post, $wp_query;

$post_id = (int)$wp_query->query['ac_id'];
$ac_id = get_post_meta( $post_id, METAKEY_PREFIX.'program_ac_form', true );

$ptitle = get_the_title($post_id);
$purl = get_the_permalink($post_id);

get_header(); ?>
<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <a class="backurl" href="<?=$purl?>"><?php echo __('vissza a(z)',TD); ?> <strong><?php echo $ptitle; ?></strong> <?php echo __('program adatlapjára',TD); ?></a>
  <?php echo do_shortcode('[activecampaign form='.$ac_id.']'); ?>
</div>
<?php get_footer();
