<div class="holder">
  <div class="list">
    <?php
    if ( $datas->have_posts() ):
    while ( $datas->have_posts() ):
      $datas->the_post();
      $pid = get_the_ID();

      $img = get_the_post_thumbnail_url($pid);
      $url = get_the_permalink($pid);
      $desc = get_the_excerpt($pid);

      $event_date_start = get_post_meta( $pid, METAKEY_PREFIX.'event_on_start', true );
      $event_date_end = get_post_meta( $pid, METAKEY_PREFIX.'event_on_end', true );
      $event_date_comment = get_post_meta( $pid, METAKEY_PREFIX.'event_comment', true );
      $event_helyszin = get_post_meta( $pid, METAKEY_PREFIX.'helyszin', true );

      $cimke_text = get_post_meta( $pid, METAKEY_PREFIX.'cimke_text', true );
      $cimke_color_bg = get_post_meta( $pid, METAKEY_PREFIX.'cimke_color_bg', true );
      $cimke_color_text = get_post_meta( $pid, METAKEY_PREFIX.'cimke_color_text', true );
    ?>
    <div class="item">
      <div class="wrapper">
        <div class="image">
          <div class="wrapper autocorrett-height-by-width">
            <?php if ($event_date_start): ?>
              <div class="idopont">
                <div class="ev">
                  <?php echo date('Y.', strtotime($event_date_start)); ?>
                </div>
                <div class="ho">
                  <?=utf8_encode(strftime ('%B', strtotime($event_date_start)))?>
                </div>
                <div class="nap">
                  <?php echo date('d.', strtotime($event_date_start)); ?>
                </div>
              </div>
            <?php endif; ?>
            <?php if ($cimke_text): ?>
            <div class="cimke">
              <div class="h" style="background:<?=$cimke_color_bg?>;">
                <div class="text" style="color:<?=$cimke_color_text?>;">
                  <?php echo $cimke_text; ?>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <a href="<?=$url?>"><img src="<?=$img?>" alt="<?php echo the_title(); ?>"></a>
          </div>
        </div>
        <div class="datas">
          <div class="title">
            <a href="<?=$url?>"><?php echo the_title(); ?></a>
          </div>
          <div class="desc">
            <?=$desc?>
          </div>
        </div>
        <div class="more">
          <div class="button">
            <a href="<?=$url?>"><div class="t"><?=__('Tovább', TD)?></div></a>
          </div>
          <div class="info">
            <div class="date">
              <i class="fa fa-calendar"></i>
              <?php if ($event_date_start && $event_date_end): ?>
                <?=utf8_encode(strftime ('%Y. %B %e.', strtotime($event_date_start)))?> &mdash; <?=utf8_encode(strftime ('%Y. %B %e.', strtotime($event_date_end)))?>
              <?php else: ?>
                <?=__('Érdeklődjön az időpontért!',TD)?>
              <?php endif; ?>
              <br>
              &nbsp;&nbsp;
              <?php if ($event_date_comment): ?>
                (<?=$event_date_comment?>)
              <?php else: ?>
                &nbsp;
              <?php endif; ?>
            </div>
            <div class="date">
              <i class="fa fa-map-marker"></i>
              <?php if ($event_helyszin): ?>
                <?php echo $event_helyszin; ?>
              <?php else: ?>
                <?=__('Érdeklődjön a részletekért!',TD)?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; wp_reset_postdata(); else: ?>
    <div class="no-item">
      <h2><?php echo __('Nincs találat.',TD); ?></h2>
      <?php echo __('Jelenleg nincs aktuális program ajánlatunk. Kérjük nézzen vissza később!',TD); ?>
    </div>
  <? endif; ?>
  </div>
</div>
