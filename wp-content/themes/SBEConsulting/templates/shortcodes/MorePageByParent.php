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
    <div class="item i<?=$i?>">
      <div class="wrapper">
        <div class="image">
          <div class="wrapper">
            <a href="<?=$url?>"><img src="<?=$img?>" alt="<?php the_title(); ?>"></a>
          </div>
        </div>
        <div class="datas">
          <div class="title">
            <a href="<?=$url?>"><?php the_title(); ?></a>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; wp_reset_postdata(); else: ?>
    <div class="no-item">
      <h2><?php echo __('Nincs találat.',TD); ?></h2>
    </div>
  <? endif; ?>
  </div>
</div>
