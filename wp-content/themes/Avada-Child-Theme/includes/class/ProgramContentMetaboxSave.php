<?php
  class ProgramContentMetaboxSave implements MetaboxSaver
  {
    public function __construct()
    {
    }
    public function saving($post_id, $post)
    {
      global $wpdb;
      $set = array();
      $adder = $_POST[METAKEY_PREFIX . 'programcontents_add'];

      foreach ((array)$adder as $a) {
        if( $a == '' ) continue;
        $set[] = $a;
      }

      $set = serialize($set);
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'programcontents_set', $set );
      unset($set);

      $content_sets = $_POST[METAKEY_PREFIX . 'program_contents'];
      foreach ((array)$content_sets as $setk => $datas) {
        $savekey = METAKEY_PREFIX.'program_contents_'.$setk;
        $datas = maybe_serialize($datas);
        $datas = addslashes($datas);

        auto_update_post_meta( $post_id, $savekey, $datas );
      }
    }
  }
?>
