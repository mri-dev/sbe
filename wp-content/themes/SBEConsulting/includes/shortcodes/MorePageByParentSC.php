<?php
class MorePageByParentSC
{
    const SCTAG = 'more-post-by-page';

    public function __construct()
    {
        add_action( 'init', array( &$this, 'register_shortcode' ) );
    }

    public function register_shortcode() {
        add_shortcode( self::SCTAG, array( &$this, 'do_shortcode' ) );
    }

    public function do_shortcode( $attr, $content = null )
    {
      global $post;
      /* Set up the default arguments. */
      $defaults = apply_filters(
          self::SCTAG.'_defaults',
          array(
            'limit' => 5,
          )
      );

      /* Parse the arguments. */
      $attr = shortcode_atts( $defaults, $attr );

      $meta_query = array();

      $parentid = wp_get_post_parent_id();

      $param = array(
        'post_type' => 'page',
        'posts_per_page' => $attr['limit'],
        'post__not_in' => array($post->ID),
        'orderby' => 'rand'
      );

      if ($parentid) {
        $param['post_parent'] = $parentid;
      }

      $datas = new WP_Query( $param );
      $attr['datas'] = $datas;

      $pass_data = $attr;

      $output = '<div class="'.self::SCTAG.'-holder">';
      $output .= (new ShortcodeTemplates('MorePageByParent'))->load_template( $pass_data );
      $output .= '</div>';

      /* Return the output of the tooltip. */
      return apply_filters( self::SCTAG, $output );
  }
}

new MorePageByParentSC();

?>
