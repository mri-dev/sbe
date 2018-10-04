<?php
class ProgramHistorySC
{
    const SCTAG = 'program-history';

    public function __construct()
    {
        add_action( 'init', array( &$this, 'register_shortcode' ) );
    }

    public function register_shortcode() {
        add_shortcode( self::SCTAG, array( &$this, 'do_shortcode' ) );
    }

    public function do_shortcode( $attr, $content = null )
    {
      global $wpdb;
        /* Set up the default arguments. */
        $defaults = apply_filters(
            self::SCTAG.'_defaults',
            array(
              'limit' => 2,
              'style' => 'default'
            )
        );

        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );

        // load
        $ids = array();
        $data = $wpdb->get_results($wpdb->prepare("SELECT post_id FROM `sbe_program_history` WHERE blog_id = %d and ip = %s ORDER BY last_visited DESC", get_current_blog_id(), $_SERVER['REMOTE_ADDR']));

        if ($data) {
          foreach ($data as $d) {
            $ids[] = $d->post_id;
          }
        }
        unset($data);

        if (!empty($ids)) {
          $datas = get_posts(array(
            'post_type' => 'programok',
            'post__in' => $ids,
            'orderby' => 'post__in',
            'posts_per_page' => (int)$attr['limit']
          ));
        }

        $pass_data = $attr;

        $pass_data['datas'] = $datas;
        unset($datas);

        $output = '<div class="'.self::SCTAG.'-holder style-'.$attr['style'].'">';

        $output .= (new ShortcodeTemplates('ProgramHistory'))->load_template( $pass_data );
        $output .= '</div>';

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }

}

new ProgramHistorySC();

?>
