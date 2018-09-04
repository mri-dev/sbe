<?php
global $post;
// Log history view
logProgramVisitForHistory($post->ID);

$event_date_start = get_post_meta( $post->ID, METAKEY_PREFIX.'event_on_start', true );
$img = get_the_post_thumbnail_url($post->ID);
$slide_id = get_post_meta( $post->ID, METAKEY_PREFIX.'event_slide', true );

$cimke_text = get_post_meta( $post->ID, METAKEY_PREFIX.'cimke_text', true );
$cimke_color_bg = get_post_meta( $post->ID, METAKEY_PREFIX.'cimke_color_bg', true );
$cimke_color_text = get_post_meta( $post->ID, METAKEY_PREFIX.'cimke_color_text', true );
$ac_form = get_post_meta( $post->ID, METAKEY_PREFIX.'program_ac_form', true );

get_header(); ?>
<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <div class="program-page-holder">
    <div class="content-holder">
      <div class="chead">
        <div class="pagi">
          <i class="fa fa-home"></i>
          <a href="/"><? echo __('Főoldal', TD); ?></a><span class="sep">/</span><a href="/programok"><? echo __('Programok', TD); ?></a><span class="sep">/</span>
          <?php echo $post->post_title; ?>
        </div>
        <div class="labels">
          <?php if ($cimke_text != ''): ?>
          <div class="lab lab-grey" style="background:<?=$cimke_color_bg?>; color:<?=$cimke_color_text?>;">
            <? echo $cimke_text; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="cbg">
        <div class="slide-top <?=($slide_id == '' && $img != '')?'imaged':''?>">
          <?php if ($event_date_start): ?>
            <div class="idopont">
              <div class="ev">
                <?php echo date('Y.', strtotime($event_date_start)); ?>
              </div>
              <div class="ho">
                <?=utf8_encode(strftime ('%B', strtotime($event_date_start)))?>
              </div>
              <div class="nap">
                <?php echo date('d.', strtotime($event_date_start)); ?>
              </div>
            </div>
          <?php endif; ?>
          <div class="timeleft">

          </div>
          <div class="cholder">
            <?php if ($slide_id != ''): ?>
              <?php echo do_shortcode('[rev_slider alias="'.$slide_id.'"]'); ?>
            <?php else: ?>
              <img src="<?=$img?>" alt="<?=$post->post_title?>">
            <?php endif; ?>
          </div>
        </div>
        <div class="share">
          <div class="text">
            <?php echo __('Ne légy irigy, oszd meg másokkal is', TD); ?>
          </div>
          <div class="shares">
            <div class="facebook">
              <a href="#"><i class="fa fa-facebook"></i></a>
            </div>
            <div class="googleplus">
              <a href="#"><i class="fa fa-google-plus"></i></a>
            </div>
          </div>
        </div>
        <div class="desc">
          <?php echo apply_filters('the_content', get_post_field('post_content', $post->ID)); ?>
        </div>
        <div class="content-groups">
          <?php
            $setmetakey = METAKEY_PREFIX . 'programcontents_set';
            $set = unserialize(get_post_meta($post->ID, $setmetakey, true));
          ?>
          <?php foreach ( $set as $ct )
          {
            $ct_slug = sanitize_title($ct);
            $savekey = METAKEY_PREFIX.'program_contents_'.$ct_slug;
            $cont =  unserialize(get_post_meta($post->ID, $savekey, true));
            $content = apply_filters('the_content', $cont['content']);
            $hasmore = strpos( $content, '<!--more-->' );
            $ctitle = ($cont['title'] == '') ? $ct : $cont['title'];
            $uid = uniqid();
          ?>
          <div class="cgroup">
            <div class="header">
              <?=$ctitle?>
            </div>
            <div class="cin">
              <?php if ( !$hasmore ): ?>
              <?php echo $content; ?>
              <?php else: ?>
                <div class="art">
                  <?php echo substr($content, 0, $hasmore ); ?>
                </div>
                <div class="more-button-expander" data-more-expand="ctexp<?=$uid?>">
                  <span class="ico"><i class="fa fa-plus"></i></span> <?php echo __('Még több',TD); ?>
                </div>
                <div class="more-text" id="ctexp<?=$uid?>" style="display: none;">
                  <?php echo substr($content, $hasmore); ?>
                  <div class="more-button-closer" data-more-closeup="ctexp<?=$uid?>">
                    <span class="ico"><i class="fa fa-angle-up"></i></span> <?php echo __('Kevesebb',TD); ?>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <script type="text/javascript">
        (function($){
          $('*[data-more-expand]').click(function(){
            var id = $(this).data('more-expand');
            console.log('.more-text#ctexp'+id);
            $('.more-text#'+id).slideDown(400);
          });
          $('*[data-more-closeup]').click(function(){
            var id = $(this).data('more-closeup');
            console.log('.more-text#ctexp'+id);
            $('.more-text#'+id).slideUp(400);
          });
        })(jQuery);
      </script>
    </div>
    <div class="program-sidebar">
      <div class="chead">
        <div class="visiting">
          <?php echo sprintf(__('Ezt a programot jelenleg %d látogató nézi.', TD), 4); ?>
        </div>
      </div>
      <div class="cbg">
        <div class="title sidebar-in">
          <h1><?php echo $post->post_title; ?></h1>
        </div>
        <div class="divider wm"></div>

        <?php if( is_plugin_active( 'activecampaign-subscription-forms/activecampaign.php' ) && $ac_form != '' ) { ?>
        <div class="requester">
          <a href="/jelentkezes/<?=$post->ID?>">+ <?php echo __('Jelentkezés', TD); ?></a>
        </div>
        <?php } ?>

        <?php $map_address = get_post_meta($post->ID, METAKEY_PREFIX . 'maps_cim', true); ?>
        <?php if ($map_address): ?>
        <div class="divider"></div>
        <div class="map sidebar-in">
          <div class="map-holder">
            <div class="head">
              <?php echo __('A program helyszíne:', TD); ?>
              <div class="address">
                <i class="fa fa-map-marker"></i> <?php echo $map_address; ?>
              </div>
            </div>
            <div class="mapshow" id="map">
              <iframe
                frameborder="0" style="border:0"
                src="https://www.google.com/maps/embed/v1/place?key=<?=GOOGLE_API_KEY?>
                  &q=<?php echo $map_address; ?>" allowfullscreen>
              </iframe>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php $linkek = get_post_meta($post->ID, METAKEY_PREFIX . 'linkek', true); ?>
        <?php if ($linkek): ?>
        <div class="divider wm"></div>
        <div class="links sidebar-in">
          <h3><?php echo __('Linkek', TD); ?></h3>
          <div class="in-cont">
            <?php echo $linkek; ?>
          </div>
        </div>
        <?php endif; ?>
        <?php
          // Hasonló programok
          $rec_ids_by_tags = getRecommendedPostIDSByTags('programok', $post->ID);
          if(!empty($rec_ids_by_tags)):
          $pass_data = array();
          $param = array(
            'post_type' => 'programok',
            'posts_per_page' => 2,
            'post__in' => (array)$rec_ids_by_tags,
            'orderby' => 'post__in'
          );
          $datas = new WP_Query( $param );
          $found_item = (int)$datas->found_posts;

          $pass_data = $param;
          $pass_data['datas'] = $datas;

        if ( $found_item > 0 && !empty($rec_ids_by_tags)):
        ?>
        <div class="divider"></div>
        <div class="related-programs sidebar-in">
          <h3><?php echo __('Hasonló programok', TD); ?></h3>
          <div class="program-list-holder style-single-row">
            <?php echo (new ShortcodeTemplates('ProgramList'))->load_template( $pass_data ); ?>
          </div>
        </div>
      <?php endif; endif; ?>

        <div class="divider"></div>
        <div class="program-search sidebar-in">
          <h3><?php echo __('Program keresés', TD); ?></h3>
          <div class="naptarstdpicker" ng-app="Calendar" ng-controller="Programs" ng-init="init()">
            <md-date-range-picker
              first-day-of-week="1"
              one-panel="true"
              localization-map="localizationMap"
              selected-template="calendarModel.selectedTemplate"
              selected-template-name="calendarModel.selectedTemplateName"
              __custom-templates="customPickerTemplates"
              md-on-select="syncCalendarItems()"
              disable-templates="TD YD TW LW TM LM LY TY"
              date-start="calendarModel.dateStart"
              date-end="calendarModel.dateEnd">
            </md-date-range-picker>

            <div class="naptar-submit" ng-click="submitSearch()">
              <?php echo __('Programok keresése',TD); ?>
            </div>
          </div>
        </div>

        <div class="program-visited sidebar-in">
          <h3><?php echo __('Eddig megtekintett programok', TD); ?></h3>
          <div class="wrapper">
            <?php echo do_shortcode('[program-history limit="5" style="simple-row"]'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer();