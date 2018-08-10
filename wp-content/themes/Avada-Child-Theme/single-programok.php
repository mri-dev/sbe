<?php
global $post;
// Log history view
logProgramVisitForHistory($post->ID);

get_header(); ?>
<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
  ...
</div>
<?php get_footer();
