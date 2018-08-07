<div class="wrapper" ng-app="Calendar">
  <div class="header">
    <div class="wrapper">
      <div class="title">
        <h3><?php echo __('Programnaptár', TD);  ?></h3>
      </div>
      <div class="goto">
        <a href="#"><?php echo __('Összes program', TD);  ?> <i class="fa fa-gear"></i></a>
      </div>
    </div>
  </div>
  <div class="napcoltroller">
    <div class="holder">
      <div class="selector">
        <div class="wrapper">
          <div class="sbar">
            <div class="space"></div>
            <div class="pre-button">
              <div><?php echo __('Egyéni', TD); ?></div>
            </div>
            <div class="space"></div>
            <div class="divider"></div>
            <div class="space"></div>
            <div class="pre-button">
              <div><?php echo __('Ma', TD); ?></div>
            </div>
            <div class="pre-button wbg">
              <div><?php echo __('Aktuális hét', TD); ?></div>
            </div>
            <div class="pre-button">
              <div><?php echo __('Az elkövetkezendő 7 nap', TD); ?></div>
            </div>
            <div class="pre-button">
              <div><?php echo __('Ebben a hónapban', TD); ?></div>
            </div>
            <div class="space"></div>
            <div class="hl-event">
              kiemelt
            </div>
          </div>
          <div class="picker">
            <md-date-range-picker
              first-day-of-week="1"
              one-panel="true"
              localization-map="localizationMap"
              selected-template="calendarModel.selectedTemplate"
              selected-template-name="calendarModel.selectedTemplateName"
              show-template="true"
              is-disabled-date="isDisabledDate($date)"
              custom-templates="customPickerTemplates"
              disable-templates="TD YD TW LW TM LM LY TY"
              date-start="calendarModel.dateStart"
              date-end="calendarModel.dateEnd">
            </md-date-range-picker>
          </div>
        </div>
      </div>
      <div class="programs-list">
        <div class="wrapper">
          <div class="header">
            <div class="img"></div>
            <div class="dateplace">
              <?php echo __('Dátum - Helyszín', TD); ?>
            </div>
            <div class="title">
              <?php echo __('Program neve', TD); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
