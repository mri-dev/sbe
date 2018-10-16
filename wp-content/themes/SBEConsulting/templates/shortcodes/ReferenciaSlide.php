<div class="wrapper">
  <?php if (count($datas) != 0): ?>
  <?php foreach ( (array)$datas as $d ): ?>
    <?php
      $img = get_the_post_thumbnail_url($d->ID);
    ?>
  <div class="referencia">
    <img src="<?=$img?>" alt="<?=$d->post_title?>">
  </div>
  <?php endforeach; ?>
  <?php endif; ?>
</div>
<script type="text/javascript">
  (function($){
    $(function(){
      $('.referencia-slide-holder > .wrapper').slick({
        arrows: false,
        autoplay: true,
        slidesToScroll: 1,
        slidesToShow: 5
      });
    });
  })(jQuery);
</script>
