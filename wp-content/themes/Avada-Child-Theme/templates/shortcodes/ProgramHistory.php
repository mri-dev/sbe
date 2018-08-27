<div class="wrapper">
  <?php
    if (empty($datas)):
  ?>
    <div class="no-items">
      <?php echo __('Nincsenek megtekintési előzmények.',TD); ?> <a href="/programok/"><?php echo __('Programok böngészés',TD); ?> <i class="fa fa-search"></i></a>
    </div>
  <?php
    else:
    foreach ( $datas as $d ):
      $img = get_the_post_thumbnail_url($d->ID);
      $url = get_the_permalink($d->ID);

      $event_date_start = get_post_meta( $d->ID, METAKEY_PREFIX.'event_on_start', true );
      $event_date_end = get_post_meta( $d->ID, METAKEY_PREFIX.'event_on_end', true );
      $event_date_comment = get_post_meta( $d->ID, METAKEY_PREFIX.'event_comment', true );
      $event_helyszin = get_post_meta( $d->ID, METAKEY_PREFIX.'helyszin', true );
    ?>
    <article class="history">
      <div class="wrapper">
        <div class="inf">
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
        </div>
        <?php if ($style != 'simple-row'): ?>
        <div class="img">
          <img src="<?=$img?>" alt="<?php echo $d->post_title; ?>">
        </div>
        <?php endif; ?>
        <div class="desc">
          <div class="title">
            <a href="<?=$url?>"><?php echo $d->post_title; ?></a>
          </div>
          <div class="pos">
            <i class="fa fa-map-marker"></i>
            <?php if ($event_helyszin): ?>
              <?php echo $event_helyszin; ?>
            <?php else: ?>
              <?=__('Érdeklődjön a részletekért!',TD)?>
            <?php endif; ?>
          </div>
        </div>
        <div class="go">
          <a href="<?=$url?>"><i class="fa fa-angle-right"></i></a>
        </div>
      </div>
    </article>
  <?php endforeach; endif; ?>
</div>
