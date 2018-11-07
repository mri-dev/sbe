<?php
global $post, $wp_query;
get_header();
$sites = sbe_sites();

$subscribe_done = false;
$subs_error = array();

if (isset($_POST['subs_name'])) {
  if (empty($_POST['subs_name'])) {
    $subs_error[] = __('Feliratkozáshoz adja meg a saját nevét!',  TD);
  }
  if (empty($_POST['subs_email'])) {
    $subs_error[] = __('Feliratkozáshoz adja meg a saját e-mail címét!',  TD);
  }

  if ( !isset($_POST['subs_accept'])) {
    $subs_error[] = __('Fogadja el a feltételeket a feliratkozáshoz!',  TD);
  }

  if (empty($subs_error))
  {
    add_filter( 'wp_mail_from','getMailSender');
    add_filter( 'wp_mail_from_name','getMailSenderName');
    add_filter( 'wp_mail_content_type','getMailFormat');

    $to = get_option('admin_email', '');
    $subject = 'Új feliratkozási igény: '.$_POST['subs_site'];

    $message = '<h2>Új feliratkozasi igény érkezet</h2>'."<br><br>";
    $message .= '<div>Név: <strong>'.$_POST['subs_name'].'</strong></div>'."<br>";
    $message .= '<div>E-mail: <strong>'.$_POST['subs_email'].'</strong></div>'."<br>";
    $message .= '<div>Csopor / website: <strong>'.$_POST['subs_site'].'</strong></div>'."<br>";

    $headers = array();
    $headers[]  = 'Reply-To: '.$_POST['subs_name'].' <'.$_POST['subs_email'].'>';

    $alert = wp_mail( $to, $subject, $message );

    if ( $alert ) {
      $subscribe_done = true;
    }
  }
}

function getMailFormat() {
  return "text/html";
}

function getMailSender($default) {
  return get_option('admin_email');
}

function getMailSenderName($default) {
  return get_option('blogname', 'Wordpress');
}

?>
<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <?php while( have_posts() ) : the_post(); ?>
    <?php echo the_content(); ?>
    <?php if (!$subscribe_done): ?>
      <?php foreach ((array)$subs_error as $err): ?>
      <div class="subs-error">
        <?php echo $err; ?>
      </div>
      <?php endforeach; ?>
    <?php elseif($subscribe_done): ?>
      <div class="subs-success">
        <?php echo __('Köszönjük! Sikeresen elküldte a feliratkozási igényét!', TD); ?> <a href="/"><?php echo __('Tovább a főoldalra >>', TD); ?></a>
      </div>
    <?php endif; ?>
    <form action="/feliratkozas" method="post" onsubmit="" class="standalone-subscriber-holder">
      <div class="wrapper">
        <div class="details">
          <div class="wrapper">
            <div class="name">
              <div class="inp-wrapper">
                <div class="ico">
                  <i class="fa fa-user"></i>
                </div>
                <input type="text" name="subs_name" value="<?=$_POST['subs_name']?>" placeholder="<?=__('Név', TD)?>">
              </div>
            </div>
            <div class="email">
              <div class="inp-wrapper">
                <div class="ico">
                  <i class="fa fa-envelope"></i>
                </div>
                <input type="text" name="subs_email" value="<?=$_POST['subs_email']?>" placeholder="<?=__('Email', TD)?>">
              </div>
            </div>
            <div class="site">
              <div class="select-wrapper">
                <select class="" name="subs_site">
                  <?php foreach ($sites as $site): ?>
                  <option value="<?=$site->name?>"><?=$site->name?></option>
                  <?php endforeach; ?>
                </select>
                <div class="ico">
                  <i class="fa fa-angle-down"></i>
                </div>
              </div>
            </div>
            <div class="accept">
              <input type="checkbox" name="subs_accept" id="subs_accept"> <label for="subs_accept"><?php echo sprintf(__('Adataim magadásával, elfogadom <a href="%s">ÁSZF</a> és az <a href="%s">Adatkezelési Tájékoztató</a> feltételeit és hozzájárulok ahhoz, hogy a sbe.hu ismertető leveleket küldjön nekem a megadott névre és email címre.', TD), '/aszf', '/adatvedelmi-tajekoztato'); ?></label>
            </div>
          </div>
        </div>
        <div class="sub-button">
          <button type="submit">
            <div class="t">
              <?php echo __('Feliratkozom!',TD); ?>
            </div>
          </button>
        </div>
      </div>
    </form>
    <br><br><br><br>
  <?php endwhile; ?>
</div>
<?php get_footer();
