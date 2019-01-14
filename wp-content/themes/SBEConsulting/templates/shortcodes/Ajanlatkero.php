<a name="_form"></a>
<form id="mailsend" action="" method="post">
  <input type="hidden" name="formtype" value="<?=$tipus?>">
  <input type="hidden" class="g-recaptcha" name="g-recaptcha-response" value="">
  <div class="group-holder requester-holder" style="width: <?=$width?>%;">
      <div class="flxtbl">
        <div class="name">
          <div class="form-input-holder">
            <input type="text" id="name" name="name" class="form-control" placeholder="<?=__('Név', TD)?> *" value="">
          </div>
        </div>
        <div class="email">
          <div class="form-input-holder">
            <input type="text" id="email" name="email" class="form-control" placeholder="<?=__('E-mail', TD)?> *" value="">
          </div>
        </div>
        <div class="company">
          <div class="form-input-holder">
            <input type="text" id="company" name="company" class="form-control" placeholder="<?=__('Cégnév', TD)?> *" value="">
          </div>
        </div>
        <div class="phone">
          <div class="form-input-holder">
            <input type="text" id="phone" name="phone" class="form-control" placeholder="<?=__('Telefonszám', TD)?> *" value="">
          </div>
        </div>
        <div class="uzenet">
          <div class="form-input-holder">
            <textarea name="uzenet" id="uzenet" class="form-control" placeholder="<?=__('Üzenet', TD)?> *"></textarea>
          </div>
        </div>
        <div class="checkboxes">
          <div class="form-input-holder">
            <input type="checkbox" class="cb" id="cb_adatkezeles" name="adatkezeles" value=""> <label for="cb_adatkezeles">* <? echo sprintf(__('Az SBE Consulting Kft. <a href="%s" target="_blank">Adatkezelési Szabályzatát</a> elolvastam, tudomásul vettem és maradéktalanul elfogadom!', TD),'/adatvedelmi-tajekoztato/'); ?></label>
          </div>
          <div class="form-input-holder">
            <input type="checkbox" class="cb" id="cb_ajanlatok" name="ajanlatok" value=""> <label for="cb_ajanlatok"><? echo __('Maradjunk kapcsolatban: A checkbox bepipálásával hozzájárul ahhoz, hogy sok izgalmas programtípusról küldjünk e-mailben inspiráló ötleteket!', TD); ?></label>
          </div>
        </div>
      </div>
  </div>
  <div class="btns">
    <div id="mail-msg" style="display: none; width: <?=$width?>%;">
      <div class="alert"></div>
    </div>
    <button type="button" id="mail-sending-btn" onclick="ajanlatkeresKuldes();"><?php echo $button_text; ?></button>
  </div>
</form>


<script type="text/javascript">
var mail_sending_progress = 0;
var mail_sended = 0;
function ajanlatkeresKuldes()
{
  if(mail_sending_progress == 0 && mail_sended == 0){
    jQuery('#mail-sending-btn').html('<?php echo __('<?php echo $whatisit; ?> küldése folyamatban', 'Avada'); ?> <i class="fa fa-spinner fa-spin"></i>').addClass('in-progress');
    jQuery('#mailsend .missing').removeClass('missing');

    mail_sending_progress = 1;
    var mailparam  = jQuery('#mailsend').serializeArray();
    jQuery.post(
      '<?php echo admin_url('admin-ajax.php'); ?>?action=contact_form',
      mailparam,
      function(data){
        var resp = jQuery.parseJSON(data);
        if(resp.error == 0) {
          mail_sended = 1;
          jQuery('#mail-sending-btn').html('<?php echo __( $whatisit.' elküldve', 'Avada'); ?> <i class="fa fa-check-circle"></i>').removeClass('in-progress').addClass('sended');
          setTimeout(function(){
            window.location.href = '/sikeres-ajanlatkeres/';
          }, 2000);
        } else {
          jQuery('#mail-sending-btn').html('<?php echo $button_text; ?>').removeClass('in-progress');
          jQuery('#mail-msg').show();
          jQuery('#mail-msg .alert').html(resp.msg).addClass('alert-danger');
          mail_sending_progress = 0;
          if(resp.missing != 0) {
            jQuery.each(resp.missing_elements, function(i,e){
              jQuery('#mailsend #'+e).addClass('missing');
            });
          }
        }
      }
    );
  }
}
</script>
