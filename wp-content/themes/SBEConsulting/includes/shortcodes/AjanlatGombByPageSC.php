<?php
class AjanlatGombByPageSC
{
    const SCTAG = 'ajanlat-gomb-page';

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

      $button_text = 'Ajánlatot kérek';
      $whatisit = 'Ajánlatkérés';

  	  /* Set up the default arguments. */
      $defaults = apply_filters(
          self::SCTAG.'_defaults',
          array(
            'text' => 'Épp ilyen rendezvényt szeretnék',
            'bgcolor' => '#4b8bf5',
            'color' => 'white',
            'acid' => false
          )
      );
      /* Parse the arguments. */
      $attr = shortcode_atts( $defaults, $attr );
      $pass_data = array();

      $pass_data['pageid'] = $post->ID;

      $pass_data = array_merge($pass_data, $attr);

      $output = '<div class="'.self::SCTAG.'-holder">';
      $output .= (new ShortcodeTemplates('AjanlatGomb'))->load_template( $pass_data );
      $output .= '</div>';

      /* Return the output of the tooltip. */
      return apply_filters( self::SCTAG, $output );
    }

}

new AjanlatGombByPageSC();

?>
