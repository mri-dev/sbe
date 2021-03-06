<?php
class ReferenciaSlideSC
{
    const SCTAG = 'referencia-slide';

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
          )
      );

      $data = get_posts(array(
        'post_type' => 'referenciak',
        'posts_per_page' => -1,
        'orderby' => 'rand'
      ));

      /* Parse the arguments. */
      $attr = shortcode_atts( $defaults, $attr );
      $pass_data = array();
      $pass_data['datas'] = $data;
      $pass_data = array_merge($pass_data, $attr);
      $output = '<div class="'.self::SCTAG.'-holder">';
      $output .= (new ShortcodeTemplates('ReferenciaSlide'))->load_template( $pass_data );
      $output .= '</div>';

      /* Return the output of the tooltip. */
      return apply_filters( self::SCTAG, $output );
    }

}

new ReferenciaSlideSC();

?>
