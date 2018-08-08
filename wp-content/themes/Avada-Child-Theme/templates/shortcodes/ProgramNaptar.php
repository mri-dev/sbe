<div class="wrapper" ng-app="Calendar" ng-controller="Programs" ng-init="init()">
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
            <div class="pre-button" ng-class="(customDateEnable)?'wbg':''" ng-click="allowCustomDateSelect(true)">
              <div><?php echo __('Egyéni', TD); ?></div>
            </div>
            <div class="space"></div>
            <div class="divider"></div>
            <div class="space"></div>
            <div class="pre-button" ng-click="changeDateTemplate(dtemp)" ng-class="(calendarModel.selectedTemplate == dtemp.name && !customDateEnable)?'wbg':''" ng-repeat="dtemp in customPickerTemplates">
              <div class="">{{dtemp.name}}</div>
            </div>
            <div class="space"></div>
            <div class="hl-event">
              <div class="wrapper">
                <div class="title">
                  <a href="#">Program címe</a>
                </div>
                <div class="date">
                  <i class="fa fa-calendar"></i> 2014.07.19., szombat.
                </div>
                <div class="pos">
                  <i class="fa fa-map-marker"></i> <strong>Siófok-Aranypart</strong>,<br>Móricz Zsigmond u. 20.
                </div>
                <div class="link">
                  <a href="#">+ <?php echo __('jelentkezés', TD);  ?></a>
                </div>
              </div>
            </div>
          </div>
          <div class="picker">
            <div class="sel-dates">
              <div class="start">
                <input type="date" name="" ng-disabled="!customDateEnable" ng-model="calendarModel.dateStart">
              </div>
              <div class="div">
                &mdash;
              </div>
              <div class="end">
                <input type="date" name="" ng-disabled="!customDateEnable" ng-model="calendarModel.dateEnd">
              </div>
            </div>
            <md-date-range-picker
              first-day-of-week="1"
              one-panel="true"
              localization-map="localizationMap"
              selected-template="calendarModel.selectedTemplate"
              selected-template-name="calendarModel.selectedTemplateName"
              __custom-templates="customPickerTemplates"
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
