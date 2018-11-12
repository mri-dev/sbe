<div class="nav-slides">
  <div class="wrapper">
    <?php $si = 1; foreach ($slides as $slide):
      $event_date_start = get_post_meta( $slide->ID, METAKEY_PREFIX.'event_on_start', true );
      $event_date_end = get_post_meta( $slide->ID, METAKEY_PREFIX.'event_on_end', true );
      $event_date_comment = get_post_meta( $slide->ID, METAKEY_PREFIX.'event_comment', true );
    ?>
    <div class="slide <?=($si==1)?'active':''?> slide-rs-<?=$slide->ID?>">
      <div class="wrapper">
        <a href="javascript:void(0);" onclick="slideNavGoTo('rs-<?=$slide->ID?>')">
          <div class="ico">
            <i class="fa fa-calendar"></i>
          </div>
          <div class="title">
            <?php echo $slide->post_title; ?>
          </div>
          <div class="subtitle">
            <?php if ($event_date_start && $event_date_end): ?>
              <?=utf8_encode(strftime ('%Y. %B %e.', strtotime($event_date_start)))?> &mdash; <?=utf8_encode(strftime ('%Y. %B %e.', strtotime($event_date_end)))?>
            <?php else: ?>
              <?=__('Érdeklődjön az időpontért!',TD)?>
            <?php endif; ?>
            <?php if ($event_date_comment): ?>
              <br>(<?=$event_date_comment?>)
            <?php endif; ?>
          </div>
        </a>
      </div>
    </div>
    <?php $si++; endforeach; ?>
  </div>
</div>

<div class="programs-slider-views">
  <div class="wrapper">
    <?php $si = 1; foreach ($slides as $slide):
        $img = get_the_post_thumbnail_url($slide->ID);
        $url = get_the_permalink($slide->ID);
        $event_date_start = get_post_meta( $slide->ID, METAKEY_PREFIX.'event_on_start', true );
        $event_date_end = get_post_meta( $slide->ID, METAKEY_PREFIX.'event_on_end', true );
        $event_date_comment = get_post_meta( $slide->ID, METAKEY_PREFIX.'event_comment', true );
        $event_helyszin = get_post_meta( $slide->ID, METAKEY_PREFIX.'helyszin', true );
      ?>
    <div class="slide <?=($si==1)?'active':''?> slide-rs-<?=$slide->ID?>">
      <div class="wrapper">
        <div class="header">
          <div class="title">
            <?php echo $slide->post_title; ?>
          </div>
        </div>
        <div class="cholder">
          <?php if ( $img ): ?>
          <div class="image">
            <div class="wrapper">
              <a href="<?=$url?>"><img src="<?=$img?>" alt="<?php echo $slide->post_title; ?>"></a>
            </div>
          </div>
          <?php endif; ?>
          <div class="params">
            <div class="header">
              <div class="title">
                <?=__('Időpont', TD)?> <i class="fa fa-calendar"></i>
              </div>
            </div>
            <div class="c">
              <?php if ($event_date_start && $event_date_end): ?>
                <?=utf8_encode(strftime ('%Y. %B %e.', strtotime($event_date_start)))?> &mdash; <?=utf8_encode(strftime ('%Y. %B %e.', strtotime($event_date_end)))?>
              <?php else: ?>
                <?=__('Érdeklődjön az időpontért!',TD)?>
              <?php endif; ?>
              <?php if ($event_date_comment): ?>
                <br>(<?=$event_date_comment?>)
              <?php endif; ?>
            </div>
            <div class="header">
              <div class="title">
                <?=__('Helyszín', TD)?> <i class="fa fa-map-marker"></i>
              </div>
            </div>
            <div class="c">
              <?php if ($event_helyszin): ?>
                <?php echo $event_helyszin; ?>
              <?php else: ?>
                <?=__('Érdeklődjön a részletekért!',TD)?>
              <?php endif; ?>
            </div>
          </div>
          <div class="info">
            <div class="header">
              <div class="title">
                <?=__('Ismertető', TD)?>
              </div>
            </div>
            <div class="c">
              <?php echo get_the_excerpt($slide->ID); ?>
            </div>
            <a href="<?=$url?>" class="more"><?=__('Részletes program ismertető',TD)?></a>
          </div>
        </div>
      </div>
    </div>
    <?php $si++; endforeach; ?>
  </div>
</div>
