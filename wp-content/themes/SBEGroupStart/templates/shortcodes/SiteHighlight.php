<div class="wrapper">
  <?php foreach ((array)$sites as $site):
    switch_to_blog($site->blog_id);
    $logo = '//'.str_replace($site->prefix.'.', '', $site->domain).'/wp-content/themes/SBEGroupStart/logos/'.$site->prefix.'.svg';
    $front_page_id = get_option( 'page_on_front' );
    $front_page_image = get_the_post_thumbnail_url($front_page_id);
  ?>
  <div class="site site-of-<?=$site->prefix?>" style="flex-basis: <?=$flexbasis?>%;">
    <div class="wrapper">
      <div class="image autocorrett-height-by-width" data-img-ratio="4:3">
        <img src="<?=$front_page_image?>" alt="">
      </div>
      <div class="landing-title">
        <?php echo get_option('landing_title', true); ?>
      </div>
      <div class="title">
        <?=$site->name?>
        <div class="desc">
          <?php echo get_bloginfo('description'); ?>
        </div>
      </div>
      <div class="content-wrapper">
        <div class="logo">
          <img src="<?=$logo?>" alt="<?=$site->name?>">
        </div>
        <div class="hl-text">
          <?php echo apply_filters('the_content', get_option('about_us_desc', true)); ?>
        </div>
      </div>
      <div class="domain">
        <a href="<?=get_site_url($site->blog_id)?>"><?=__('Tovább', TD)?></a>
      </div>
    </div>
  </div>
  <?php restore_current_blog(); endforeach; ?>
</div>
