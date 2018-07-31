<div class="holder">
  <div class="list">
    <?php
    foreach ( $datas as $d ):
      $img = get_the_post_thumbnail_url($d->ID);
      $url = get_the_permalink($d->ID);
      $desc = get_the_excerpt($d->ID);

      $event_date_start = get_post_meta( $d->ID, METAKEY_PREFIX.'event_on_start', true );
      $event_date_end = get_post_meta( $d->ID, METAKEY_PREFIX.'event_on_end', true );
      $event_date_comment = get_post_meta( $d->ID, METAKEY_PREFIX.'event_comment', true );
      $event_helyszin = get_post_meta( $d->ID, METAKEY_PREFIX.'helyszin', true );
    ?>
    <div class="item">
      <div class="wrapper">
        <div class="image">
          <div class="wrapper">
            <a href="<?=$url?>"><img src="<?=$img?>" alt="<?php echo $d->post_title; ?>"></a>
          </div>
        </div>
        <div class="datas">
          <div class="title">
            <a href="<?=$url?>"><?php echo $d->post_title; ?></a>
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
    <?php endforeach; ?>
  </div>
</div>
