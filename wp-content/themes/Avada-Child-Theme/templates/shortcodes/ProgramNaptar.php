<div class="wrapper" ng-controller="Programs" ng-init="init()">
  <div class="header">
    <div class="wrapper">
      <div class="title">
        <h3><?php echo __('Programnaptár', TD);  ?></h3>
      </div>
      <div class="goto">
        <a href="/programok"><?php echo __('Összes program', TD);  ?> <i class="fa fa-gear"></i></a>
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
            <div class="hl-event" ng-show="kiemelt_program.title">
              <div class="wrapper">
                <div class="title">
                  <a href="{{kiemelt_program.url}}" target="_blank">{{kiemelt_program.title}}</a>
                </div>
                <div class="date">
                  <i class="fa fa-calendar"></i> {{kiemelt_program.date.start}}, {{kiemelt_program.date.weekday}}.
                </div>
                <div class="pos">
                  <i class="fa fa-map-marker"></i> <span ng-bind-html="kiemelt_program.pos"></span>
                </div>
                <div class="link" ng-show="kiemelt_program.ac_form">
                  <a href="/jelentkezes/{{kiemelt_program.id}}" target="_blank">+ <?php echo __('jelentkezés', TD);  ?></a>
                </div>
              </div>
            </div>
          </div>
          <div class="picker">
            <div class="sel-dates">
              <div class="start">
                <input type="date" name="" ng-disabled="!customDateEnable" ng-change="syncCalendarItems()" ng-model="calendarModel.dateStart">
              </div>
              <div class="div">
                &mdash;
              </div>
              <div class="end">
                <input type="date" name="" ng-disabled="!customDateEnable" ng-change="syncCalendarItems()" ng-model="calendarModel.dateEnd">
              </div>
            </div>
            <md-date-range-picker
              first-day-of-week="1"
              one-panel="true"
              localization-map="localizationMap"
              selected-template="calendarModel.selectedTemplate"
              selected-template-name="calendarModel.selectedTemplateName"
              __custom-templates="customPickerTemplates"
              md-on-select="syncCalendarItems()"
              disable-templates="TD YD TW LW TM LM LY TY"
              highlighted-dates="calendarModel.highlightedDates"
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
          <div class="cont">
            <div class="loading" ng-show="syncing">
              <?php echo __('Programok betöltése folyamatban...', TD); ?> <i class="fa fa-spin fa-spinner"></i>
            </div>
            <div class="no-items" ng-show="!syncing && events.length==0">
              <i class="fa fa-calendar-o"></i><br>
              <?php echo __('A kiválasztott időszakban nincs esemény:', TD); ?><br>
              <strong ng-show="!customDateEnable">{{calendarModel.selectedTemplateName}}</strong>
              <strong ng-show="customDateEnable">{{calendarModel.dateStart|date:'yyyy.MM.dd.'}} - {{calendarModel.dateEnd|date:'yyyy.MM.dd.'}}</strong>
            </div>
            <div class="events" ng-show="!syncing && events.length!=0">
              <div class="event" ng-repeat="event in events">
                <div class="wrapper">
                  <div class="img">
                    <a href="{{event.url}}"><img ng-src="{{event.img}}" alt="{{event.title}}"></a>
                  </div>
                  <div class="dateplace">
                    <div class="info-text" ng-show="(!event.date.start && !event.pos)">
                      <i class="fa fa-calendar"></i> <?php echo __('Érdeklődjön a részletekért!', TD); ?>
                    </div>
                    <div class="date" ng-show="event.date.start">
                      <i class="fa fa-calendar"></i> {{event.date.start}}, {{event.date.weekday}}<br>{{event.date.comment}}
                    </div>
                    <div class="pos" ng-show="event.pos">
                      <i class="fa fa-map-marker"></i> <span ng-bind-html="event.pos"></span>
                    </div>
                  </div>
                  <div class="title">
                    <h4><a href="{{event.url}}">{{event.title}}</a></h4>
                    <div class="desc">
                        {{event.desc}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
