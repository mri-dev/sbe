<div class="inside">
  <?php if ($controll == 'deadline'): ?>
    <div class="dateback-holder">
      <div class="wrapper">
        <div class="db-day">
          <div class="v">
            20
          </div>
          <div class="stext">
            <?=__('nap',TD)?>
          </div>
        </div>
        <div class="db-hour">
          <div class="v">
            10
          </div>
          <div class="stext">
            <?=__('óra',TD)?>
          </div>
        </div>
        <div class="db-min">
          <div class="v">
            16
          </div>
          <div class="stext">
            <?=__('perc',TD)?>
          </div>
        </div>
      </div>
    </div>
  <?php elseif ($controll == 'jelentkezes'): ?>
    <a href="<?=$url?>#jelentkezes">+<?=__('Jelentkezés', TD)?></a>
  <?php elseif ($controll == 'eventdateinfo'): ?>
    <?php if ($event_date_start && $event_date_end): ?>
      <?=$event_date_start?> &mdash; <?=$event_date_end?>
    <?php else: ?>
      <?=__('Érdeklődjön az időpontért!',TD)?>
    <?php endif; ?>
    <?php if ($event_date_comment): ?>
      <br>(<?=$event_date_comment?>)
    <?php endif; ?>
  <?php endif; ?>
</div>
