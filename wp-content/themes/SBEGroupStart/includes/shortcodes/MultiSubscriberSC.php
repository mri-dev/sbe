<?php
class MultiSubscriberSC
{
    const SCTAG = 'multi-subscriber';

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
            array()
        );

        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );

        $sites = sbe_sites();
        $rerange_sites = array();
        $site_order = array('consulting', 'gastro', 'sport');
        $fb = ($sites) ? 100/count($sites) : 100;

        foreach ((array)$sites as $s) {
          $pos = array_search($s->prefix, $site_order);
          $rerange_sites[$pos] = $s;
        }

        ksort($rerange_sites);
        $sites = $rerange_sites;
        unset($rerange_sites);

        $meta_query = array();

        $pass_data = $attr;
        $pass_data['sites'] = $sites;

        $output = '<div class="'.self::SCTAG.'-holder">';
        $output .= (new ShortcodeTemplates('MultiSubscriber'))->load_template( $pass_data );
        $output .= '</div>';

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }
}

new MultiSubscriberSC();

?>
