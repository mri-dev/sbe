<?php
class Setup_General_Settings {
  function Setup_General_Settings( ) {
      add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
  }
  function register_fields() {
      register_setting( 'general', 'phone', 'esc_attr' );
      add_settings_field('phone', '<label for="phone">'.__('Kapcsolat telefonszám' , 'phone' ).'</label>' , array(&$this, 'phone_cb') , 'general' );

      register_setting( 'general', 'address', 'esc_attr' );
      add_settings_field('address', '<label for="address">'.__('Cím' , 'address' ).'</label>' , array(&$this, 'address_cb') , 'general' );

      register_setting( 'general', 'landing_title', 'esc_attr' );
      add_settings_field('landing_title', '<label for="landing_title">'.__('Langing címfelirat' , 'landing_title' ).'</label>' , array(&$this, 'landing_title_cb') , 'general' );


      register_setting( 'general', 'about_us_title', 'esc_attr' );
      add_settings_field('about_us_title', '<label for="about_us_title">'.__('Rólunk - Cím (lábrész)' , 'about_us_title' ).'</label>' , array(&$this, 'about_us_title_cb') , 'general' );

      register_setting( 'general', 'about_us_desc');
      add_settings_field('about_us_desc', '<label for="about_us_desc">'.__('Rólunk - Tartalom (lábrész)' , 'about_us_desc' ).'</label>' , array(&$this, 'about_us_desc_cb') , 'general' );
  }

  function landing_title_cb() {
      $value = get_option( 'landing_title', '' );
      echo '<input class="regular-text" type="text" id="landing_title" name="landing_title" value="' . $value . '" />';
  }
  function phone_cb() {
      $value = get_option( 'phone', '' );
      echo '<input class="regular-text" type="text" id="phone" name="phone" value="' . $value . '" />';
  }
  function address_cb() {
      $value = get_option( 'address', '' );
      echo '<input class="regular-text" type="text" id="address" name="address" value="' . $value . '" />';
  }
  function about_us_title_cb() {
      $value = get_option( 'about_us_title', '' );
      echo '<input class="regular-text" type="text" id="about_us_title" name="about_us_title" value="' . $value . '" />';
  }

  function about_us_desc_cb() {
      $value = get_option( 'about_us_desc', '' );
      wp_editor($value, 'about_us_desc' );
  }
}

?>
