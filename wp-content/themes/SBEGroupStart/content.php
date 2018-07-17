<div class="landing-content">
  <div class="desc">
    <?php echo the_content(); ?>
  </div>
  <div class="group-list">
    <div class="wrapper">
      <div class="sbc">
        <a href="https://consulting.sbe.ideasandbox.eu/"><img src="" alt="">SBE Consulting</a>
      </div>
      <div class="sbs">
        <a href="https://sport.sbe.ideasandbox.eu/"><img src="" alt="">SBE Sport és Borbarátok Egyesülete</a>
      </div>
      <div class="gbc">
        <a href="https://gastro.sbe.ideasandbox.eu/"><img src="" alt="">SBE Gastro Business Club</a>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    (function($){
      motionTopDesign();
      var motionInt = setInterval(motionTopDesign, 3500);

      function motionTopDesign() {
        console.log('motion');
        c1 = randGenWith();
        c2 = randGenWith(),
        c3 = 100 - (c1+c2);

        $('.top-design > .blue').animate({
          flexBasis: c1+'%'
        }, 3000);
        $('.top-design > .red').animate({
          flexBasis: c2+'%'
        }, 3000);
        $('.top-design > .gold').animate({
          flexBasis: c3+'%'
        }, 3000);
      }

      function randGenWith() {
        return Math.floor(Math.random() * 40) + 10;
      }

    })(jQuery);
  </script>
</div>
