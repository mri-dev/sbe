<div class="header-container">
  <div class="wrapper">
    <div class="site-navs">
      <div class="holder">
        <?php $sites = sbe_sites(); ?>
        <?php foreach ($sites as $site): ?>
        <div class="site site-<?=$site->prefix?><?=(get_current_blog_id() == $site->blog_id)?' current-site':''?>">
          <?php if (get_current_blog_id() == $site->blog_id): ?>
            <a href="//<?=$site->domain?>" class="logo"><img src="<?=IMG?>/<?=$site->prefix?>/main_logo.svg" alt="<?=$site->name?>"></a>
          <?php else: ?>
            <a href="//<?=$site->domain?>"><?=$site->name?></a>
          <?php endif; ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="menu">
      <?php
        wp_nav_menu(array(
          'menu' => 'Főmenü'
        ));
      ?>
    </div>
    <div class="social">
      <?php
        $social = new Avada_Social_Icons();
        $icons = $social->render_social_icons(array(
          'position' => 'header'
        ));
        echo $icons;
      ?>
    </div>
  </div>
</div>
