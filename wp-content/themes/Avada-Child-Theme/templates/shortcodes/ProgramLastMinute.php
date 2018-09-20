<?php while( $data->have_posts() ) {
  $data->the_post();
  $pid = get_the_ID();
  $szazalek = get_post_meta( $pid, METAKEY_PREFIX.'kedvezmeny_szazalek', true );
  $szazalek = ($szazalek != '') ? $szazalek : '??';
  $szazalek_text = get_post_meta( $pid, METAKEY_PREFIX.'kedvezmeny_comment', true );
  $url = get_the_permalink( $pid );
  $ac_form = get_post_meta( $pid, METAKEY_PREFIX.'program_ac_form', true );
?>
  <div class="holder">
    <div class="kedv">
      <div class="wrapper">
        <div class="kedvv">
          <div class="kt">
            <?php echo __('kedvezmény', TD); ?>
          </div>
          <?=$szazalek?><span class="pr">%</span>
        </div>
        <?php if ($szazalek_text != ''): ?>
          <div class="ast-text">
            <span class="ast">*</span> <?=$szazalek_text?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="leiras">
      <div class="wrapper">
        <div class="cimke">Last Minute</div>
        <div class="title"><?=the_title()?></div>
        <div class="desc"><?php echo get_the_excerpt($pid); ?></div>
        <div class="url">
          <?php if( is_plugin_active( 'activecampaign-subscription-forms/activecampaign.php' ) && $ac_form != '') { ?>
              <a href="/jelentkezes/<?=$pid?>">+ <?=__('Jelentkezés', TD)?></a>
          <?php }else{ ?>
            <a href="<?=$url?>"><?=__('Program adatlapja', TD)?></a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
