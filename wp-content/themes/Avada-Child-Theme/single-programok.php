<?php
global $post;
// Log history view
logProgramVisitForHistory($post->ID);

get_header(); ?>
<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <div class="program-page-holder">
    <div class="content-holder">

      <div class="cbg">

      </div>
    </div>
    <div class="program-sidebar">
      <div class="chead">
        <div class="visiting">
          <?php echo sprintf(__('Ezt a programot jelenleg %d látogató nézi.', TD), 4); ?>
        </div>
      </div>
      <div class="cbg">

      </div>
    </div>
  </div>
</div>
<?php get_footer();
