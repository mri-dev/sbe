<div class="programs-slider-controller">
  <div class="wrapper">
    <?php echo do_shortcode('[program-slider]'); ?>
  </div>
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
      jQuery('.nav-slides .slide.slide-'+active_slide_id).addClass('active');

    	console.log( active_slide_id );
    	//data.currentslide - Current Slide as jQuery Object
    	//data.nextslide - Coming Slide as jQuery Object});
    });
  </script>
</div>
