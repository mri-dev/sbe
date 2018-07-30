<div class="programs-slider-controller">
  <?php echo do_shortcode('[program-slider]'); ?>

  <script type="text/javascript">
    var revapi1 = jQuery(document).ready(function() {
        jQuery('#rev_slider_1').show().revolution({});
    });
    function slideNavGoTo( id ) {
      revapi1.revcallslidewithid(id);
    }
    revapi1.bind("revolution.slide.onchange",function (e, d) {

      var active_slide_id = d.currentslide.context.dataset.slideactive;
      jQuery('.nav-slides .slide.active').removeClass('active');
      jQuery('.programs-slider-views .slide.active').removeClass('active');
      jQuery('.nav-slides .slide.slide-'+active_slide_id).addClass('active');
      jQuery('.programs-slider-views .slide.slide-'+active_slide_id).addClass('active');
    });
  </script>
</div>
