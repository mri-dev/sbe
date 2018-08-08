var calendar = angular.module('Calendar', ['ngMaterial', 'ngMessages', 'ngMaterialDateRangePicker']);

calendar.controller('Programs', ['$scope', '$http', '$mdToast', '$mdDialog', '$httpParamSerializerJQLike', '$mdDateRangePicker', function($scope, $http, $mdToast, $mdDialog, $httpParamSerializerJQLike, $mdDateRangePicker)
{
  var date = new Date();

  $scope.customDateEnable = false;
  $scope.calendarModel = {
    selectedTemplate: 'Aktuális hét',
    selectedTemplateName: null,
    dateStart: null,
    dateEnd: null
  };

  $scope.getMonthFirstLast = function(){
    var date = new Date();
    var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
    var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    return [firstDay, lastDay];
  }

  $scope.getWeekDay = function( what )
  {
    var curr = new Date; // get current date
    var first = curr.getDate() - curr.getDay() + 1; // First day is the day of the month - the day of the week
    var last = first + 6; // last day is the first day + 6

    var firstday = new Date(curr.setDate(first));
    var lastday = new Date(curr.setDate(last));

    return ( what == 'first') ? firstday : lastday;
  }

  $scope.changeDateTemplate = function(temp)
  {
    $scope.customDateEnable = false;
    $scope.calendarModel.selectedTemplate = temp.name;
    $scope.calendarModel.dateStart = temp.dateStart;
    $scope.calendarModel.dateEnd = temp.dateEnd;

    $scope.syncCalendarItems();
  }

  $scope.allowCustomDateSelect = function( flag )
  {
    if (flag) {
      $scope.customDateEnable = flag;
      $scope.calendarModel.dateStart = null;
      $scope.calendarModel.dateEnd = null;
    } else {
      $scope.customDateEnable = flag;
    }
  }

  var monthfirstlast = $scope.getMonthFirstLast();

  // datepicker
  $scope.customPickerTemplates = [
    {
      name: 'Ma',
      dateStart: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
      dateEnd: new Date(date.getFullYear(), date.getMonth(), date.getDate())
    },
    {
      name: 'Aktuális hét',
      dateStart: $scope.getWeekDay('first'),
      dateEnd: $scope.getWeekDay('last')
    },
    {
      name: 'Az elkövetkezendő 7 nap',
      dateStart: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
      dateEnd: new Date(date.getFullYear(), date.getMonth(), date.getDate() + 7)
    },
    {
      name: 'Ebben a hónapban',
      dateStart: monthfirstlast[0],
      dateEnd: monthfirstlast[1]
    }
  ];

  $scope.localizationMap = {
    'Mon': 'H',
    'Tue': 'K',
    'Wed': 'Sz',
    'Thu': 'Cs',
    'Fri': 'P',
    'Sat': 'Szo',
    'Sun': 'V',
    'Today': 'Ma',
    'Yesterday': 'Tegnap',
    'This week': 'Ez a hét',
    'Last week': 'Utolsó hét',
    'This month': 'Ez a hónap',
    'Last month': 'Utolsó hónap',
    'This year': 'Ez az év',
    'Last year': 'Utolsó év',
    'January': 'Január',
    'February': 'Február',
    'March': 'Március',
    'April': 'Április',
    'May': 'Május',
    'June': 'Június',
    'July': 'Július',
    'August': 'Augusztus',
    'September': 'Szeptember',
    'October': 'Október',
    'November': 'November',
    'December': 'December'
  };


  $scope.init = function(){

  }

  $scope.syncCalendarItems = function() {

  }

}]);
