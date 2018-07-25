<div class="header-container">
  <div class="wrapper">
    <div class="site-navs">
      <div class="holder">
        <?php $sites = sbe_sites(); ?>
        <?php foreach ($sites as $site): ?>
        <div class="site site-<?=$site->prefix?><?=(get_current_blog_id() == $site->blog_id)?' current-site':''?>">
          <a href="//<?=$site->domain?>"><?=$site->name?></a>
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
