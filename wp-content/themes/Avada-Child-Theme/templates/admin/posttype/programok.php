<?php
  global $wpdb, $post;
?>
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
</table>
<script type="text/javascript">
  jQuery( document ).ready( function( $ ) {
    $('.datepicker').datepicker();
} );
</script>