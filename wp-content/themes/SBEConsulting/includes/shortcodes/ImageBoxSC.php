<?php
class ImageBoxSC
{
    const SCTAG = 'imagebox';

    public function __construct()
    {
        add_action( 'init', array( &$this, 'register_shortcode' ) );
    }

    public function register_shortcode() {
        add_shortcode( self::SCTAG, array( &$this, 'do_shortcode' ) );
    }

    public function do_shortcode( $attr, $content = null )
    {
      global $post, $wpdb;
      /* Set up the default arguments. */
      $defaults = apply_filters(
        self::SCTAG.'_defaults',
        array(
          'style' => 'standard',
          'limit' => -1,
          'show' => 3,
          'galleryid' => 0,
          'order' => false
        )
      );
      /* Parse the arguments. */
      $attr = shortcode_atts( $defaults, $attr );
      $image_db = $wpdb->prefix.'bwg_image';
      $boxhash = uniqid();

      if (!class_exists('BWG')) {
        return false;
      }

      $datas = $wpdb->get_results($wpdb->prepare("SELECT g.id, g.slug, g.filename, g.description, g.image_url, g.resolution FROM ".$image_db." as g WHERE 1=1 and g.published = 1 and g.gallery_id = %d ORDER BY ". ( ($attr['order']) ? 'rand()' : 'g.order ASC' ) ." ".( ($attr['limit'] != -1) ? 'LIMIT 0,'.$attr['limit'] : '' ) , $attr['galleryid']), ARRAY_A);

      if (!empty($datas)) {
        $datas = array_map(function($v){
          $upload_dir = BWG()->upload_url;
          $v['image_url'] = $upload_dir.$v['image_url'];
          return $v;
        }, $datas);
        $attr['datas'] = $datas;
        $attr['boxhash'] = $boxhash;

        $pass_data = $attr;

        $output = '<div id="box'.$boxhash.'" class="'.self::SCTAG.'-holder style-'.$attr['style'].'">';
        $output .= (new ShortcodeTemplates('ImageBox'))->load_template( $pass_data );
        $output .= '</div>';
      }

      /* Return the output of the tooltip. */
      return apply_filters( self::SCTAG, $output );
  }
}

new ImageBoxSC();

?>
