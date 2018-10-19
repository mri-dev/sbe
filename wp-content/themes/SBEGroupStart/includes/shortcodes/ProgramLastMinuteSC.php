<?php
class ProgramLastMinuteSC
{
    const SCTAG = 'lastminute-program';

    public function __construct()
    {
        add_action( 'init', array( &$this, 'register_shortcode' ) );
    }

    public function register_shortcode() {
        add_shortcode( self::SCTAG, array( &$this, 'do_shortcode' ) );
    }

    public function do_shortcode( $attr, $content = null )
    {
        /* Set up the default arguments. */
        $defaults = apply_filters(
            self::SCTAG.'_defaults',
            array(
            )
        );

        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );

        $pass_data = $attr;

        $params = array(
          'post_type' => 'programok',
          'posts_per_page' => 1,
          'order' => 'rand',
          'tax_query' => array(
            array(
                'taxonomy' => 'kategoria',
                'field' => 'slug',
                'terms' => 'last-minute',
            )
          ),
          'meta_query' => array(
            array(
              'key' => METAKEY_PREFIX.'event_on_start',
              'value' => date('Y-m-d'),
              'compare' => '>=',
              'type' => 'DATE'
            )
          )
        );
        $data = new WP_Query( $params );

        if ( $data->have_posts() )
        {
          $pass_data['data'] = $data;
          $output = '<div class="'.self::SCTAG.'-holder">';
          $output .= (new ShortcodeTemplates('ProgramLastMinute'))->load_template( $pass_data );
          $output .= '</div>';
        }

        wp_reset_postdata();

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }

}

new ProgramLastMinuteSC();

?>
