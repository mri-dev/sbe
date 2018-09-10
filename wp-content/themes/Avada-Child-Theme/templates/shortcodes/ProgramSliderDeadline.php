<div class="inside">
  <?php if ($controll == 'deadline'): ?>
    <div class="dateback-holder" >
      <div class="wrapper">
        <?php if ($event_date_start): ?>
        <timer end-time="<?=$event_date_start?>">
        <div class="db-day">
          <div class="v">
            {{days}}
          </div>
          <div class="stext">
            <?=__('nap',TD)?>
          </div>
        </div>
        <div class="db-hour">
          <div class="v">
            {{hours}}
          </div>
          <div class="stext">
            <?=__('óra',TD)?>
          </div>
        </div>
        <div class="db-min">
          <div class="v">
            {{minutes}}
          </div>
          <div class="stext">
            <?=__('perc',TD)?>
          </div>
        </div>
        </timer>
        <?php else: ?>
        <div class="no-time-defined">
          <?=__('Érdeklődjön az időpontért!',TD)?>
        </div>
        <?php endif; ?>
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
