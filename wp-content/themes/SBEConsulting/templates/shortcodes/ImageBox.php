<div class="stack-holder">
  <?php
    if($style == 'standard'){
      $show = ($show) ?: 3;
      $show = (int)$show;
      $flexbasis = 100 / $show;
    }
  ?>
  <?php foreach ((array)$datas as $img): ?>
  <div class="image" style="<?=($flexbasis)?'flex-basis:'.$flexbasis.'%;':''?>">
    <div class="wrapper autocorrett-height-by-width" data-img-ratio="4:3">
      <img src="<?=$img['image_url']?>" alt="<?=$img['slug']?>">
    </div>
  </div>
  <?php endforeach; ?>
</div>
<? if($style=="slide"): ?>
<script type="text/javascript">
  (function($){
    $(function(){
      $('.imagebox-holder#box<?=$boxhash?> > .stack-holder').slick({
        arrows: true,
        dots: false,
        autoplay: true,
        speed: 1000,
        slidesToScroll: 1,
        slidesToShow: <?=$show?>
      });
    });
  })(jQuery);
</script>
<? endif; ?>
