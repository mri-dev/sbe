<h1>Szállás adatok</h1>
<table class="<?=TD?>">
  <tr>
    <td>
      <?php $metakey = METAKEY_PREFIX . 'szallas_weburi'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Szállás weboldala (URL)</strong></label></p>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input autocomplete="off" id="<?=$metakey?>" type="text" name="<?=$metakey?>" value="<?=$value?>">
    </td>
  </tr>
  <tr>
    <td>
      <?php $metakey = METAKEY_PREFIX . 'szallas_address'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Szállás címe - Térkép</strong></label></p>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input autocomplete="off" id="<?=$metakey?>" type="text" name="<?=$metakey?>" value="<?=$value?>">
    </td>
  </tr>
  <tr>
    <td>
      <?php $metakey = METAKEY_PREFIX . 'szallas_extra'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Extra a szálláson</strong></label></p>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input autocomplete="off" id="<?=$metakey?>" type="text" name="<?=$metakey?>" value="<?=$value?>">
    </td>
  </tr>
</table>

<h1>Szolgáltatások</h1>
<?php $metakey = METAKEY_PREFIX . 'szallas_programok'; ?>
<?php $value = get_post_meta($post->ID, $metakey, true); ?>
<?php wp_editor($value, $metakey ); ?>
