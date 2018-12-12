<?php

class AjaxRequests
{
  public function __construct()
  {
    return $this;
  }

  public function test()
  {
    add_action( 'wp_ajax_'.__FUNCTION__, array( $this, 'testcls'));
    add_action( 'wp_ajax_nopriv_'.__FUNCTION__, array( $this, 'testcls'));
  }

  public function contact_form()
  {
    add_action( 'wp_ajax_'.__FUNCTION__, array( $this, 'ContactFormRequest'));
    add_action( 'wp_ajax_nopriv_'.__FUNCTION__, array( $this, 'ContactFormRequest'));
  }

  public function Calendar()
  {
    add_action( 'wp_ajax_'.__FUNCTION__, array( $this, 'CalendarRequest'));
    add_action( 'wp_ajax_nopriv_'.__FUNCTION__, array( $this, 'CalendarRequest'));
  }

  public function CalendarRequest()
  {
    extract($_POST);
    $return = array(
      'error' => 0,
      'msg' => '',
      'data' => array(),
      'dates' => array(),
      'params' => $_POST
    );

    $meta_query = array();
    $tax_query = array();

    $params = array(
      'post_type' => 'programok',
      'posts_per_page' => (isset($limit) && $limit != '') ? $limit: -1
    );

    if ( !empty($datestart) && !empty($dateend) )
    {
      $meta_query['relation'] = 'OR';
      $meta_query[] = array(
        'key' => METAKEY_PREFIX.'event_on_start',
        'value' => array($datestart, $dateend),
        'compare' => 'BETWEEN',
        'type' => 'DATE'
      );
      $meta_query[] = array(
        'key' => METAKEY_PREFIX.'event_on_end',
        'value' => array($datestart, $dateend),
        'compare' => 'BETWEEN',
        'type' => 'DATE'
      );
    } else if( !empty($datestart) && empty($dateend) ){
      $params['orderby'] = 'rand';
      $meta_query[] = array(
        'key' => METAKEY_PREFIX.'event_on_start',
        'value' => $datestart,
        'compare' => '>=',
        'type' => 'DATE'
      );
    }

    if ( isset($kiemelt) && $kiemelt == '1' )
    {
      $tax_query[] = array(
        'taxonomy' => 'kategoria',
  			'field'    => 'slug',
  			'terms'    => 'kiemelt',
      );
    }

    $params['meta_query'] = $meta_query;
    $params['tax_query'] = $tax_query;
    $datas = array();

    $return['filter'] = $params;

    $qry = new WP_Query( $params );

    if ($qry->have_posts()) {
      while ( $qry->have_posts() ) {
        $qry->the_post();

        $id = get_the_ID();
        $img = get_the_post_thumbnail_url($id);
        $url = get_the_permalink($id);
        $desc = get_the_excerpt($id);

        $event_date_start = get_post_meta( $id, METAKEY_PREFIX.'event_on_start', true );
        $event_date_end = get_post_meta( $id, METAKEY_PREFIX.'event_on_end', true );
        $event_date_comment = get_post_meta( $id, METAKEY_PREFIX.'event_comment', true );
        $event_helyszin = get_post_meta( $id, METAKEY_PREFIX.'helyszin', true );
        $ac_form = get_post_meta( $id, METAKEY_PREFIX.'program_ac_form', true );

        if ( !is_plugin_active( 'activecampaign-subscription-forms/activecampaign.php' ) ) {
          $ac_form = false;
        } else if($ac_form == '') {
          $ac_form = false;
        }

        $datas[] = array(
          'id' => $id,
          'title' => get_the_title( $id ),
          'url' => $url,
          'img' => $img,
          'desc' => $desc,
          'pos' => $event_helyszin,
          'ac_form' => $ac_form,
          'date' => array(
            'start' => ($event_date_start) ? date('Y.m.d.', strtotime($event_date_start)) : false,
            'end' => ($event_date_end) ? date('Y.m.d.', strtotime($event_date_end)) : false,
            'weekday' => utf8_encode(strftime ('%A', strtotime($event_date_start))),
            'comment' => $event_date_comment
          )
        );
      }

      wp_reset_postdata();
    }

    $return['data'] = $datas;

    unset($datas);
    unset($qry);

    // Possible dates
    $dates = array();
    $params = array(
      'post_type' => 'programok',
      'posts_per_page' => -1
    );
    $qry = new WP_Query( $params );

    if ($qry->have_posts()) {
      while ( $qry->have_posts() ) {
        $qry->the_post();
        $id = get_the_ID();

        $event_date_start = get_post_meta( $id, METAKEY_PREFIX.'event_on_start', true );
        $event_date_end = get_post_meta( $id, METAKEY_PREFIX.'event_on_end', true );

        $btwdates = $this->dateLineCalc($event_date_start, $event_date_end);
        if ($btwdates) {
          foreach ((array)$btwdates as $bd) {
            if (!in_array($bd, $dates)) {
              $dates[] = $bd;
            }
          }
        }
      }

      wp_reset_postdata();
    }

    if ($dates) {
      $return['dates'] = $dates;
    }

    echo json_encode($return);
    die();
  }

  private function dateLineCalc( $start, $end )
  {
    $tstart = strtotime($start);
    $tend = strtotime($end);

    $dd = round(($tend - $tstart) / (60 * 60 * 24));

    if ( $dd == 0 && $start != '' )
    {
      return array($start);
    } else if($dd != 0) {
      $ds = array();
      for ($i=$dd;$i>=0;$i--){
        $ds[] = date('Y-m-d', strtotime($start.' +'.$i.' days'));
      }

      return $ds;
    }
  }

  public function ContactFormRequest()
  {
    extract($_POST);
    $return = array(
      'error' => 0,
      'msg'   => '',
      'missing_elements' => [],
      'error_elements' => [],
      'missing' => 0,
      'passed_params' => false
    );

    $err_elements_text = '';

    $return['passed_params'] = $_POST;
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $uzenet = $_POST['uzenet'];
    $irsz = $_POST['irsz'];
    $helyseg = $_POST['helyseg'];
    $contacttype = $_POST['formtype'];
    $szinvalaszto  = ($_POST['szinvalaszto'] == '1') ? true : false;

    switch ($contacttype) {
      case 'ajanlat':
        $contact_type = 'ajánlatkérés';
        if ($szinvalaszto) {
          $contact_type = 'színválasztó ' . $contact_type;
        }
      break;
      case 'kapcsolat':
        $contact_type = 'kapcsolat üzenet';
      break;
      case 'szallitas':
        $contact_type = 'szállítás - szerelés érdeklődés';
      break;
    }

    if(empty($name)) $return['missing_elements'][] = 'name';
    if(empty($email)) $return['missing_elements'][] = 'email';
    if(empty($phone)) $return['missing_elements'][] = 'phone';

    if(empty($colorconfig['haz_hatfal'])) $return['missing_elements'][] = 'colorconfig_haz_hatfal';
    if(empty($colorconfig['haz_teteje'])) $return['missing_elements'][] = 'colorconfig_haz_teteje';
    if(empty($colorconfig['haz_alap'])) $return['missing_elements'][] = 'colorconfig_haz_alap';

    if ($contacttype == 'szallitas') {
      if(empty($irsz)) $return['missing_elements'][] = 'irsz';
      if(empty($helyseg)) $return['missing_elements'][] = 'helyseg';
    }

    if(!empty($return['missing_elements'])) {
      $return['error']  = 1;
      $return['msg']    =  __('Kérjük, hogy töltse ki az összes mezőt az üzenet küldéséhez.',  'Avada');

      if (
        in_array('colorconfig_haz_alap', $return['missing_elements']) ||
        in_array('colorconfig_haz_teteje', $return['missing_elements']) ||
        in_array('colorconfig_haz_alap', $return['missing_elements'])
      ) {
        $return['msg']    .= '<br>' . __('A színvariációknál válasszon ki idomonként egy színvariációt az ajánlatkérés elküldéséhez.',  'Avada');
      }

      $return['missing']= count($return['missing_elements']);
      $this->returnJSON($return);
    }

    if(!empty($return['error_elements'])) {
      $return['error']  = 1;
      $return['msg']    =  __('A következő mezők hibásan vannak kitöltve',  'Avada').":\n". $err_elements_text;
      $return['missing']= count($return['missing_elements']);
      $this->returnJSON($return);
    }

    // captcha
    $captcha_code = $_POST['g-recaptcha-response'];
    $recapdata = array(
        'secret' => CAPTCHA_SECRET_KEY,
        'response' => $captcha_code
    );
    $return['recaptcha']['secret'] = CAPTCHA_SECRET_KEY;
    $return['recaptcha']['response'] = $captcha_code;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($recapdata));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $recap_result = json_decode(curl_exec($ch), true);
    curl_close($ch);
    $return['recaptcha']['result'] = $recap_result;

    if(isset($recap_result['success']) && $recap_result['success'] === false) {
      $return['error']  = 1;
      $return['msg']    =  __('Kérjük, hogy azonosítsa magát. Ha Ön nem spam robot, jelölje be a fenti jelölő négyzetben, hogy nem robot.',  'Avada');
      $this->returnJSON($return);
    }


    $to       = get_option('admin_email');
    $subject  = sprintf(__('Új %s érkezett: %s'), $contact_type, $name);

    ob_start();
  	  include(locate_template('templates/mails/contactform.php'));
      $message = ob_get_contents();
		ob_end_clean();

    add_filter( 'wp_mail_from', array($this, 'getMailSender') );
    add_filter( 'wp_mail_from_name', array($this, 'getMailSenderName') );
    add_filter( 'wp_mail_content_type', array($this, 'getMailFormat') );

    $headers    = array();
    if (!empty($email)) {
      $headers[]  = 'Reply-To: '.$name.' <'.$email.'>';
    }

    $alert = wp_mail( $to, $subject, $message, $headers );

    /* * /
    if (!empty($email)) {
      $headers    = array();
      $headers[]  = 'Reply-To: '.get_option('blogname').' <no-reply@'.TARGETDOMAIN.'>';
      $alerttext = true;
      ob_start();
    	  include(locate_template('templates/mails/contactform-receiveuser.php'));
        $message = ob_get_contents();
  		ob_end_clean();
      $ualert = wp_mail( $email, 'Értesítés: '.$contct_type.' üzenetét megkaptuk.', $message, $headers );
    }
    /* */

    if(!$alert) {
      $return['error']  = 1;
      $return['msg']    = __('Az ajánlatkérést jelenleg nem tudtuk elküldeni. Próbálja meg később.',  'Avada');
      $this->returnJSON($return);
    }

    echo json_encode($return);
    die();
  }

  public function SzinvalasztoRequest()
  {
    extract($_POST);
    $settings = json_decode(stripslashes($_POST['settings']), true);

    $re = array(
      'error' => 0,
      'msg' => null,
      'data' => array()
    );

    switch  ( $type ) {
      case 'getSettings':
        $re['data'] = get_option('ajanlatkero_szinvalaszto_cfg', false);
      break;
      case 'saveSettings':
        update_option('ajanlatkero_szinvalaszto_cfg', $settings);
        $re['data'] = get_option('ajanlatkero_szinvalaszto_cfg', false);
      break;
    }

    echo json_encode($re);
    die();
  }

  public function testcls()
  {

    echo json_encode($return);
    die();
  }

  public function getMailFormat(){
      return "text/html";
  }

  public function getMailSender($default)
  {
    return get_option('admin_email');
  }

  public function getMailSenderName($default)
  {
    return get_option('blogname', 'Wordpress');
  }

  private function returnJSON($array)
  {
    echo json_encode($array);
    die();
  }

}
?>
