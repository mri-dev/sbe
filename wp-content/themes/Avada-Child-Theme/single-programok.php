<?php
global $post;
// Log history view
logProgramVisitForHistory($post->ID);

get_header(); ?>
<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <div class="program-page-holder">
    <div class="content-holder">
      <div class="chead">
        <div class="pagi">
          <i class="fa fa-home"></i>
          <a href="/"><? echo __('Főoldal', TD); ?></a><span class="sep">/</span><a href="/programok"><? echo __('Programok', TD); ?></a><span class="sep">/</span>
          <?php echo $post->post_title; ?>
        </div>
        <div class="labels">
          <div class="lab lab-grey">
            <? echo sprintf(__('Már csak %d db hely maradt!', TD), 3); ?>
          </div>
        </div>
      </div>
      <div class="cbg">
        <div class="slide-top">
          <div class="ondate">

          </div>
          <div class="timeleft">

          </div>
        </div>
        <div class="share">
          <div class="text">
            <?php echo __('Ne légy irigy, oszd meg másokkal is', TD); ?>
          </div>
          <div class="shares">
            <div class="facebook">
              <a href="#"><i class="fa fa-facebook"></i></a>
            </div>
            <div class="googleplus">
              <a href="#"><i class="fa fa-google-plus"></i></a>
            </div>
          </div>
        </div>
        <div class="desc">
          <?php echo get_the_excerpt($post->ID); ?>
        </div>
        <div class="content-groups">
          <div class="cgroup">
            <div class="header">
              Ízelítő
            </div>
            <div class="cin">
              <?php echo get_the_excerpt($post->ID); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="program-sidebar">
      <div class="chead">
        <div class="visiting">
          <?php echo sprintf(__('Ezt a programot jelenleg %d látogató nézi.', TD), 4); ?>
        </div>
      </div>
      <div class="cbg">
        <div class="title sidebar-in">
          <h1><?php echo $post->post_title; ?></h1>
        </div>
        <div class="divider wm"></div>

        <div class="requester sidebar-in">
          Jelentkezés...
        </div>
        <?php $map_address = get_post_meta($post->ID, METAKEY_PREFIX . 'maps_cim', true); ?>
        <?php if ($map_address): ?>
        <div class="divider"></div>
        <div class="map sidebar-in">
          <div class="map-holder">
            <div class="head">
              <?php echo __('A program helyszíne:', TD); ?>
              <div class="address">
                <i class="fa fa-map-marker"></i> <?php echo $map_address; ?>
              </div>
            </div>
            <div class="mapshow" id="map">
              <iframe
                frameborder="0" style="border:0"
                src="https://www.google.com/maps/embed/v1/place?key=<?=GOOGLE_API_KEY?>
                  &q=<?php echo $map_address; ?>" allowfullscreen>
              </iframe>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php $linkek = get_post_meta($post->ID, METAKEY_PREFIX . 'linkek', true); ?>
        <?php if ($linkek): ?>
        <div class="divider wm"></div>
        <div class="links sidebar-in">
          <h3><?php echo __('Linkek', TD); ?></h3>
          <div class="in-cont">
            <?php echo $linkek; ?>
          </div>
        </div>
        <?php endif; ?>
        <div class="divider"></div>
        <div class="related-programs sidebar-in">
          <h3><?php echo __('Hasonló programok', TD); ?></h3>
        </div>
        <div class="divider"></div>
        <div class="program-search sidebar-in">
          <h3><?php echo __('Program keresés', TD); ?></h3>
        </div>

        <div class="program-visited sidebar-in">
          <h3><?php echo __('Eddig megtekintett programok', TD); ?></h3>
          <div class="wrapper">
            <?php echo do_shortcode('[program-history limit="5" style="simple-row"]'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer();
