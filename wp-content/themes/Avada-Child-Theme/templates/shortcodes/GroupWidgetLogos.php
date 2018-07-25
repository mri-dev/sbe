<div class="wrapper">
  <?php foreach ($sites as $s): $logo = '//'.str_replace($s->prefix.'.', '', $s->domain).'/wp-content/themes/SBEGroupStart/logos/'.$s->prefix.'.svg'; ?>
  <div class="site site-<?=$s->prefix?>">
    <a title="<?=$s->name?>" href="//<?=$s->domain?>"><img src="<?=$logo?>" alt="<?=$s->name?>"></a>    
  </div>
  <?php endforeach; ?>
</div>
