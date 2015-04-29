angular.module('App', ['ngRoute', 'ui.bootstrap'])
.config(['$routeProvider', function ($routeProvider) {
  $routeProvider
    .when('/', {
      templateUrl: 'index-tmpl'
      , controller: 'SheetListController'
    })
    .when('/new', {
      templateUrl: 'new-tmpl'
      , controller: 'CreationController'
    })
    .when('/sheet/:id', {
      templateUrl: 'sheet-tmpl'
      , controller: 'SheetController'
    })
    .otherwise({
      redirectTo: '/'
    });
}])
.service('counting', [function() {
    this.getSubtotal = function(orderLine) {

      return orderLine.unitPrice * orderLine.count;
    }

    this.getTotalAmount = function (lines) {
      var totalAmount = 0;

      angular.forEach(lines, function (orderLine) {
          totalAmount += this.getSubtotal(orderLine);
      }, this);

      return totalAmount;
    }
}])
.controller('SheetListController', ['$scope', 'sheets', function SheetListController($scope, sheets) {
  $scope.list = sheets.list;
    
  $scope.from = new Date(2015, 3, 1);
  $scope.fromPickerOpen = false;
  $scope.toggleFromPicker = function($event) {
    $event.stopPropagation();

    $scope.fromPickerOpen = !$scope.fromPickerOpen;
  };
    
  $scope.to = new Date(2015, 3, 30);
  $scope.toPickerOpen = false;
  $scope.toggleToPicker = function($event) {
    $event.stopPropagation();

    $scope.toPickerOpen = !$scope.toPickerOpen;
  };

  $scope.successCallback  = function(data, status, header, config) {
      $scope.list = angular.fromJson(data.dealings);
  }
    
  $scope.$watchCollection(function() {
    return [$scope.from, $scope.to];
  }, function() {
    sheets.search($scope.from, $scope.to, $scope.successCallback);
  });

  sheets.search($scope.from, $scope.to, $scope.successCallback);
    
}])
.controller('CreationController', ['$scope', '$location', 'sheets', 'counting', function CreationController($scope, $location, sheets, counting) {
  // 新しい明細行を作成する
  function createDealing() {
    return {
      date: new Date(),
      dealing_type_id: 1,
      client: 'Client',
      description: '',
      amount: 100
    };
  }

  $scope.datePickerOpen = false;
  $scope.toggleDatePicker = function($event) {
    $event.stopPropagation();

    $scope.datePickerOpen = !$scope.datePickerOpen;
  };
    
  $scope.dealing = createDealing();
    
  $scope.integer = /^[0-9]+$/;


  $scope.save = function() {
    sheets.regist($scope.dealing, function(){ $location.path('/');});
  }
}])
.controller('SheetController', ['$scope', '$routeParams', 'sheets', 'counting', function SheetController($scope, $params, sheets, counting) {
  $scope.dealing = {};
    
  $scope.successCallback  = function(data, status, header, config) {
      $scope.dealing = angular.fromJson(data.dealing);
  }
    
  $scope.dealing = sheets.get($params.id, $scope.successCallback);
    
}])
.service('sheets', ['$http', '$filter', function($http, $filter) {
  this.list = [];

  var API_BASE = 'http://finance.localhost/app_dev.php/rest/dealing/';

  this.search = function(from, to, successCallback) {
    var url = API_BASE + 'from/';
    url += $filter('date')(from, 'yyyyMMdd');
    url += '/to/';
    url += $filter('date')(to, 'yyyyMMdd');

    $http({
	url: url,
	method: 'GET'
    })
    .success(successCallback)
    .error(function(data, status, header,config){
	console.debug('http error');
    });
  }

  this.get = function(id, successCallback) {
    var url = API_BASE + id;

    $http({
	url: url,
	method: 'GET'
    })
    .success(successCallback)
    .error(function(data, status, header,config){
	console.debug('http error');
    });
  }

  this.regist = function(dealing, successCallback) {
    var url = API_BASE + 'regist';
    dealing.date = $filter('date')(dealing.date, 'yyyy-MM-dd');
    var postData = {'dealing': dealing};

    $http.post(url, postData)
         .success(successCallback)
         .error(function(data, status, header,config){
           console.debug('http error');
          });
  }
}])
;
