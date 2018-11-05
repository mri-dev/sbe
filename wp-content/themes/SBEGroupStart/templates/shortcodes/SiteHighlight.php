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
      <div class="title">
        <?=$site->name?>
      </div>
      <div class="landing-title">
        <?php echo get_option('landing_title', true); ?>
      </div>
      <div class="content-wrapper">
        <div class="logo">
          <img src="<?=$logo?>" alt="<?=$site->name?>">
        </div>
        <div class="hl-text">
          <?php echo apply_filters('the_content', get_option('about_us_desc', true)); ?>
        </div>
      </div>
      <?php
        switch ($site->prefix) {
          default:
            $events = get_posts(array(
              'post_type' => 'programok',
              'posts_per_page' => 5,
              'orderby' => 'rand'
            ));
          break;
          case 'consulting':
            $events = get_posts(array(
              'post_type' => 'page',
              'posts_per_page' => 5,
              'orderby' => 'rand',
              'post_parent' => 7
            ));
          break;
        }
      ?>
      <?php if ($events): ?>
      <div class="posts">
        <div class="wrapper">
        <?php foreach ($events as $ev): ?>
        <div class="event">
          <a href="<?=get_permalink($ev)?>" target="_blank"><?=$ev->post_title?></a>
        </div>
        <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>
      <?php
        $avadasettings = get_option('avada_theme_options');
        $socials = $avadasettings['social_media_icons'];

        $has_social = false;
        foreach ($socials['url'] as $soc) {
          if($soc != '') {
            $has_social = true;
            break;
          }
        }
      ?>
      <?php if ($has_social): ?>
      <div class="shares">
        <div class="fusion-social-networks">
          <div class="fusion-social-networks-wrapper">
            <?php $si = 0; foreach ($socials['url'] as $socurl): if($socurl == '') continue; ?>
            <a href="<?=$socurl?>" target="_blank" class="fusion-social-network-icon fusion-tooltip fusion-<?=$socials['icon'][$si]?> fusion-icon-<?=$socials['icon'][$si]?>"></a>
            <?php $si++; endforeach; ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <div class="domain">
        <a href="<?=get_site_url($site->blog_id)?>"><?=__('Tovább', TD)?></a>
      </div>
    </div>
  </div>
  <?php restore_current_blog(); endforeach; ?>
</div>
