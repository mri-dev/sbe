<?php global $wpdb, $post; ?>
<div class="programcontents">
  <div class="wrapper">
    <div class="ct-groups">
      <?php
       $metakey = METAKEY_PREFIX . 'programcontents_set';
       $set = unserialize(get_post_meta($post->ID, $metakey, true));
      ?>
      <h4>Tartalom csoportok</h4>
      <div class="inputs">
        <?php foreach ((array)$set as $ct) { ?>
          <div class="input">
            <input type="text" name="<?=METAKEY_PREFIX?>programcontents_add[]" value="<?=$ct?>" placeholder="Új tartalom főcíme...">
          </div>
        <? } ?>
        <div class="newinputs">
          <div class="input new">
            <input type="text" name="<?=METAKEY_PREFIX?>programcontents_add[]" value="" placeholder="Új tartalom főcíme...">
          </div>
        </div>
      </div>
      <a class="new-adder" href="javascript:void(0);" onclick="addNewContentGroup()">+ új mező</a>
    </div>
    <div class="ct-sets">
      <h4>Tartalmak</h4>
      <div class="content-sets">
        <?php foreach ((array)$set as $ct) {
          $ct_slug = sanitize_title($ct);
          $meta_key = METAKEY_PREFIX . 'program_contents';
          $savekey = METAKEY_PREFIX.'program_contents_'.$ct_slug;
          echo $savekey;
          $cont =  unserialize(get_post_meta($post->ID, $savekey, true));
          print_r($cont);
        ?>
        <div class="set">
          <label for="<?=$meta_key.$ct_slug?>"><?php echo $ct; ?></label>
          <input type="text" name="<?= $meta_key.'[\''.$ct_slug.'\'][\'title\']'?>" value="" placeholder="Tartalom főcím">
          <?php wp_editor('', $meta_key.$ct_slug , array('textarea_name' => $meta_key.'[\''.$ct_slug.'\'][\'content\']')); ?>
        </div>
        <? } ?>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function addNewContentGroup() {
      jQuery(".newinputs").append('<div class="input new"><input type="text" name="<?=METAKEY_PREFIX?>programcontents_add[]" value="" placeholder="Új tartalom főcíme..."></div>');
    }
  </script>
</div>
<?php var_dump($value); ?>
