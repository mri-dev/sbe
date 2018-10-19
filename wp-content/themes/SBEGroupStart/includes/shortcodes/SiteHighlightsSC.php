<?php
class SiteHighlightsSC
{
    const SCTAG = 'site-highlights';

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

        $param = array(
          //'post_type' => 'programok',
        );
        $datas = new WP_Query( $param );
        $pass_data = $attr;
        $pass_data['sites'] = $sites;
        $pass_data['flexbasis'] = $fb;

        $output = '<div class="'.self::SCTAG.'-holder">';
        $output .= (new ShortcodeTemplates('SiteHighlight'))->load_template( $pass_data );
        $output .= '</div>';

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }
}

new SiteHighlightsSC();

?>
