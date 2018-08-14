<?php
global $post;
get_header(); ?>
<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <?php echo do_shortcode('[program-list by="legujabb" limit="12" pagination="1"]'); ?>
</div>
<?php get_footer();
