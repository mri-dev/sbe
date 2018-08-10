<?php
  global $wpdb, $post;
?>
<h1>Esemény beállítások</h1>
<table class="<?=TD?>">
  <tr>
    <td>
      <?php $metakey = METAKEY_PREFIX . 'event_on_start'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Esemény kezdő időpontja (dátum)</strong></label></p>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input autocomplete="off" id="<?=$metakey?>" type="text" class="datepicker" name="<?=$metakey?>" value="<?=$value?>">
    </td>
    <td style="width:80px;">
      <?php $metakey = METAKEY_PREFIX . 'event_on_start_time'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Óra:Perc</strong></label></p>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input autocomplete="off" id="<?=$metakey?>" type="time" name="<?=$metakey?>" placeholder="12:00" value="<?=$value?>">
    </td>
    <td>
      <?php $metakey = METAKEY_PREFIX . 'event_on_end'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Esemény befejező időpontja (dátum)</strong></label></p>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input autocomplete="off" id="<?=$metakey?>" type="text" class="datepicker" name="<?=$metakey?>" value="<?=$value?>">
    </td>
    <td style="width:80px;">
      <?php $metakey = METAKEY_PREFIX . 'event_on_end_time'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Óra:Perc</strong></label></p>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input autocomplete="off" id="<?=$metakey?>" type="time" name="<?=$metakey?>" placeholder="12:00" value="<?=$value?>">
    </td>
  </tr>
  <tr>
    <td colspan="4">
      <?php $metakey = METAKEY_PREFIX . 'event_comment'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Esemény időpont megjegyzés</strong></label></p>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input autocomplete="off" id="<?=$metakey?>" type="text" name="<?=$metakey?>" placeholder="Pl.: 5 nap, 4 éjszaka" value="<?=$value?>">
    </td>
  </tr>
  <tr>
    <td colspan="4">
      <?php $metakey = METAKEY_PREFIX . 'helyszin'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Esemény helyszíne</strong></label></p>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input autocomplete="off" id="<?=$metakey?>" type="text" name="<?=$metakey?>" value="<?=$value?>">
    </td>
  </tr>
  <tr>
    <td colspan="4">
      <?php $metakey = METAKEY_PREFIX . 'jelentkezes_zarva'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Jelentkezés lezárva</strong></label></p>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input autocomplete="off" id="<?=$metakey?>" <?=($value == 1)?'checked="checked"':''?> type="checkbox" name="<?=$metakey?>" value="">
    </td>
  </tr>
</table>
<h1>Kedvezmény</h1>
<p>Last Minute esemény esetén határozzunk megy egy kedvezmény mértéket.</p>
<table class="<?=TD?>">
  <tr>
    <td style="width: 30%;">
      <?php $metakey = METAKEY_PREFIX . 'kedvezmeny_szazalek'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Kedvezmény (%)</strong></label></p>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input autocomplete="off" id="<?=$metakey?>" type="number" min="0" name="<?=$metakey?>" value="<?=$value?>">
    </td>
    <td>
      <?php $metakey = METAKEY_PREFIX . 'kedvezmeny_comment'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Kedvezmény megjegyzés</strong></label></p>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input autocomplete="off" id="<?=$metakey?>" type="text" name="<?=$metakey?>" value="<?=$value?>">
    </td>
  </tr>
</table>
<h1>Címke</h1>
<p>Listázásban a kép felett megjelenő címke, rövid tájékoztató szöveggel.</p>
<table class="<?=TD?>">
  <tr>
    <td>
      <?php $metakey = METAKEY_PREFIX . 'cimke_text'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Címke felirata</strong></label></p>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input autocomplete="off" id="<?=$metakey?>" maxlength="40" type="text" name="<?=$metakey?>" value="<?=$value?>">
    </td>
    <td style="width: 120px;">
      <?php $metakey = METAKEY_PREFIX . 'cimke_color_bg'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Címke háttérszín</strong></label></p>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input autocomplete="off" id="<?=$metakey?>" maxlength="40" type="text" name="<?=$metakey?>" value="<?=$value?>" placeholder="pl.: #444444, black">
    </td>
    <td style="width: 120px;">
      <?php $metakey = METAKEY_PREFIX . 'cimke_color_text'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Címke szövegszín</strong></label></p>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input autocomplete="off" id="<?=$metakey?>" maxlength="40" type="text" name="<?=$metakey?>" value="<?=$value?>" placeholder="pl.: #444444, black">
    </td>
  </tr>
</table>

<script type="text/javascript">
  jQuery( document ).ready( function( $ ) {
    $('.datepicker').datepicker();
} );
</script>
