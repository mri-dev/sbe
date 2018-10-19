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

      register_setting( 'general', 'contact_ac_id', 'esc_attr' );
      add_settings_field('contact_ac_id', '<label for="contact_ac_id">'.__('Kapcsolat űrlap - Active Campaign' , 'contact_ac_id' ).'</label>' , array(&$this, 'contact_ac_id') , 'general' );

      register_setting( 'general', 'about_us_desc');
      add_settings_field('about_us_desc', '<label for="about_us_desc">'.__('Rólunk - Tartalom (lábrész)' , 'about_us_desc' ).'</label>' , array(&$this, 'about_us_desc_cb') , 'general' );

  }
  function phone_cb() {
      $value = get_option( 'phone', '' );
      echo '<input class="regular-text" type="text" id="phone" name="phone" value="' . $value . '" />';
  }
  function address_cb() {
      $value = get_option( 'address', '' );
      echo '<input class="regular-text" type="text" id="address" name="address" value="' . $value . '" />';
  }
  function landing_title_cb() {
      $value = get_option( 'landing_title', '' );
      echo '<input class="regular-text" type="text" id="landing_title" name="landing_title" value="' . $value . '" />';
  }

  function about_us_desc_cb() {
      $value = get_option( 'about_us_desc', '' );
      wp_editor($value, 'about_us_desc' );
  }

  function contact_ac_id()
  {
    $metakey = 'contact_ac_id';
    $value = get_option( 'contact_ac_id', '' );

    if ( class_exists('ActiveCampaignWordPress'))
    {
      $ac_settings = get_option("settings_activecampaign");

      if ( !empty( $ac_settings ) ) {
        $ac = new ActiveCampaignWordPress( $ac_settings['api_url'], $ac_settings['api_key']);
        $ac_instance = array();
        $ac_instance = activecampaign_getforms($ac, $ac_instance);

        echo '<div style="color: #00baea;">Csatlakozva: <strong>'.$ac_settings['account_view']['fname'].' '.$ac_settings['account_view']['lname'].'</strong> ('.$ac_settings['account_view']['account'].')</div>';
      } else {
        echo 'Kérjük, hogy adja meg az Active Campaign működéséhez az API adatokat. <a href="/wp-admin/options-general.php?page=activecampaign">Beállítás.</a>';
      }

      if( !empty($ac_settings) ):
        ?>
        <table class="<?=TD?>" style="width: 50%;">
          <tr>
            <td style="padding: 0;">
              <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Active Campaign form kiválasztása (<?=count($ac_instance['forms'])?>)</strong></label></p>
              <select class="" name="<?=$metakey?>">
                <option value="" selected="selected">-- válasszon Active Campaign formot --</option>
                <?php foreach ($ac_instance['forms'] as $ac_form_id => $form ): ?>
                <option value="<?=$ac_form_id?>" <?=($value == $ac_form_id)?'selected="selected"':''?>><?=$form['name']?></option>
                <?php endforeach; ?>
              </select>
            </td>
        </table>
        <?php
      endif;
    } else {
      ?>
        Az Active Campaign plugin nincs telepítve a modul kezeléséhez. Telepítse a plugint: <a href="https://wordpress.org/plugins/activecampaign-subscription-forms/#installation">https://wordpress.org/plugins/activecampaign-subscription-forms/#installation</a>
      <?php
    }
  }
}

?>
