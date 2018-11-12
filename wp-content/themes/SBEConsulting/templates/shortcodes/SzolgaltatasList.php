<div class="holder">
  <div class="list">
    <?php
    if ( $datas->have_posts() ):
      $i = 0;
    while ( $datas->have_posts() ):
      $i++;
      if($i != 5){
        $datas->the_post();
      }
      $pid = get_the_ID();

      $img = get_the_post_thumbnail_url($pid);
      $img = ($img) ?: IMG.'/no-image.jpg';
      $url = get_the_permalink($pid);
      $desc = get_the_excerpt($pid);
    ?>
    <?php if ($i == 5): ?>
      <div class="item i<?=$i?> fake-item ajanlat">
        <div class="wrapper">
          <div class="">
            <a href="/ajanlatkeres">
              <div class="text autocorrett-height-by-width">
                <?php echo __('Kérjen<br>ajánlatot', TD); ?>
              </div>
              <div class="ico">
                <i class="fa fa-envelope"></i>
              </div>
            </a>
          </div>
        </div>
      </div>
    <?php else: ?>
      <div class="item i<?=$i?>">
        <div class="wrapper">
          <div class="image autocorrett-height-by-width">
            <div class="wrapper">
              <a href="<?=$url?>"><img src="<?=$img?>" alt="<?php the_title(); ?>"></a>
            </div>
          </div>
          <div class="datas">
            <div class="title">
              <a href="<?=$url?>"><?php the_title(); ?></a>
            </div>
            <div class="desc">
              <?=$desc?>
            </div>
          </div>
          <div class="button">
            <a href="<?=$url?>"><div class="t"><?=__('Érdekel', TD)?></div></a>
          </div>
        </div>
      </div>
    <?php endif; ?>
  <?php endwhile; wp_reset_postdata(); else: ?>
    <div class="no-item">
      <h2><?php echo __('Nincs találat.',TD); ?></h2>
    </div>
  <? endif; ?>
  </div>
</div>
