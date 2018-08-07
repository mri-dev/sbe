var calendar = angular.module('Calendar', ['ngMaterial', 'ngMessages', 'ngMaterialDateRangePicker']);

calendar.controller('TravelCalculator', ['$scope', '$http', '$mdToast', '$mdDialog', '$httpParamSerializerJQLike', '$mdDateRangePicker', function($scope, $http, $mdToast, $mdDialog, $httpParamSerializerJQLike, $mdDateRangePicker)
{

  var date = new Date();
  $scope.calendarModel = {
    selectedTemplate: '3 nap',
    selectedTemplateName: null,
    dateStart: new Date(date.getFullYear(), date.getMonth(), date.getDate() + 2),
    dateEnd: new Date(date.getFullYear(), date.getMonth(), date.getDate() + 4)
  };

  // datepicker
  $scope.customPickerTemplates = [
    {
      name: '3 nap',
      dateStart: new Date(date.getFullYear(), date.getMonth(), date.getDate() + 2),
      dateEnd: new Date(date.getFullYear(), date.getMonth(), date.getDate() + 4)
    },
    {
      name: '5 nap',
      dateStart: new Date(date.getFullYear(), date.getMonth(), date.getDate() + 2),
      dateEnd: new Date(date.getFullYear(), date.getMonth(), date.getDate() + 6)
    },
    {
      name: '1  hét',
      dateStart: new Date(date.getFullYear(), date.getMonth(), date.getDate() + 2),
      dateEnd: new Date(date.getFullYear(), date.getMonth(), date.getDate() + 8)
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

}]);
