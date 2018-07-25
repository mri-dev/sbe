<?php
class GroupWidgetLogosSC
{
    const SCTAG = 'group-widget-logos';

    public function __construct()
    {
        add_action( 'init', array( &$this, 'register_shortcode' ) );
    }

    public function register_shortcode() {
        add_shortcode( self::SCTAG, array( &$this, 'do_shortcode' ) );
    }

    public function do_shortcode( $attr, $content = null )
    {
        $output = '<div class="'.self::SCTAG.'-holder">';

        $sites = sbe_sites();

    	  /* Set up the default arguments. */
        $defaults = apply_filters(
            self::SCTAG.'_defaults',
            array(

            )
        );
        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );
        $attr['sites'] = $sites;
        $output .= (new ShortcodeTemplates('GroupWidgetLogos'))->load_template($attr);

        $output .= '</div>';

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }

}

new GroupWidgetLogosSC();

?>
