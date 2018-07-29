<div class="nav-slides">
  <div class="wrapper">
    <?php $si = 1; foreach ($slides as $slide): ?>
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
            2014. június 28. - július 2. szombat-szerda<br>(5 nap, 4 éjszaka)
          </div>
        </a>
      </div>
    </div>
    <?php $si++; endforeach; ?>
  </div>
</div>
