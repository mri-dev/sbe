<?php
class ProgramSliderDeadlineSC
{
    const SCTAG = 'program-slider-helper';

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
              'url' => false,
              'controll' => false
            )
        );

        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );

        $attr['postid'] = url_to_postid( $attr['url'] );

        $pass_data = $attr;

        if ( $attr['controll'] == 'eventdateinfo')
        {
          $event_date_start = get_post_meta( $attr['postid'], METAKEY_PREFIX.'event_on_start', true );
          $event_date_end = get_post_meta( $attr['postid'], METAKEY_PREFIX.'event_on_end', true );
          $event_date_comment = get_post_meta( $attr['postid'], METAKEY_PREFIX.'event_comment', true );

          if ($event_date_start) {
            $pass_data['event_date_start'] = utf8_encode(strftime ('%Y. %B %e.', strtotime($event_date_start)));
          }

          if ($event_date_end) {
            $pass_data['event_date_end'] = utf8_encode(strftime ('%Y. %B %e.', strtotime($event_date_end)));
          }

          if ($event_date_comment) {
            $pass_data['event_date_comment'] = $event_date_comment;
          }
        }
        elseif( $attr['controll'] == 'deadline' )
        {
          $event_date_start = get_post_meta( $attr['postid'], METAKEY_PREFIX.'event_on_start', true );
          $event_date_start_time = get_post_meta( $attr['postid'], METAKEY_PREFIX.'event_on_start_time', true );
          if ($event_date_start) {
            $pass_data['event_date_start'] =  strtotime($event_date_start." ".$event_date_start_time) * 1000;
          }
        }

        $output = '<div class="'.self::SCTAG.'-holder ctrl-'.$attr['controll'].'">';

        $output .= (new ShortcodeTemplates('ProgramSliderDeadline'))->load_template( $pass_data );
        $output .= '</div>';

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }

}

new ProgramSliderDeadlineSC();

?>
