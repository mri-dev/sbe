<?php
  class ProgramMetaboxSave implements MetaboxSaver
  {
    public function __construct()
    {
    }
    public function saving($post_id, $post)
    {
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'event_comment', $_POST[METAKEY_PREFIX . 'event_comment'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'event_on_start', $_POST[METAKEY_PREFIX . 'event_on_start'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'event_on_end', $_POST[METAKEY_PREFIX . 'event_on_end'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'event_on_start_time', $_POST[METAKEY_PREFIX . 'event_on_start_time'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'event_on_end_time', $_POST[METAKEY_PREFIX . 'event_on_end_time'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'helyszin', $_POST[METAKEY_PREFIX . 'helyszin'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'kedvezmeny_szazalek', $_POST[METAKEY_PREFIX . 'kedvezmeny_szazalek'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'kedvezmeny_comment', $_POST[METAKEY_PREFIX . 'kedvezmeny_comment'] );
    }
  }
?>
