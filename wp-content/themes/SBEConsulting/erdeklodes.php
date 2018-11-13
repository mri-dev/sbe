<?php
global $post, $wp_query;

get_header(); ?>
<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <h1 style="text-align:center;"><?php echo __('Ajánlatkérés', TD); ?></h1>
  <br>
  <div class="clearfix fusion-clearfix clr"></div>
  <?php echo do_shortcode("[contact-form]"); ?>
</div>
<?php get_footer();
