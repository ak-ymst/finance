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

  $scope.successFunction  = function(data, status, header, config) {
      $scope.list = angular.fromJson(data.dealings);
  }
    
  $scope.$watchCollection(function() {
    return [$scope.from, $scope.to];
  }, function() {
    sheets.search($scope.from, $scope.to, $scope.successFunction);
  });

  sheets.search($scope.from, $scope.to, $scope.successFunction);
    
}])
.controller('CreationController', ['$scope', '$location', 'sheets', 'counting', function CreationController($scope, $location, sheets, counting) {
  // 新しい明細行を作成する
  function createOrderLine() {
    return {
      productName: '',
      unitPrice: 0,
      count: 0
    };
  }

  $scope.lines = [createOrderLine()]; // 明細行リスト
  $scope.integer = /^[0-9]+$/;

  $scope.isDisabled = function() {
    return $scope.lines.length < 2;  
  }

  $scope.addLine = function() {
    $scope.lines.push(createOrderLine());
  }

  $scope.initialize = function() {
    $scope.lines = [createOrderLine()];
  }

  $scope.save = function() {
    sheets.add($scope.lines);

    $location.path('/');
  }

  $scope.removeLine = function(target) {
    var lines = $scope.lines;
    var index = lines.indexOf(target);

    if (index != -1) {
      lines.splice(index, 1);
    }
  }

  angular.extend($scope, counting);
    
}])
.controller('SheetController', ['$scope', '$routeParams', 'sheets', 'counting', function SheetController($scope, $params, sheets, counting) {
    var sheet = sheets.get($params.id);

    angular.extend($scope, sheet);
    angular.extend($scope, counting);
}])
.service('sheets', ['$http', '$filter', function($http, $filter) {
  this.list = [];

  this.search = function(from, to, successFunction) {
    var url = 'http://finance.localhost/app_dev.php/rest/dealing/from/';
    url += $filter('date')(from, 'yyyyMMdd');
    url += '/to/';
    url += $filter('date')(to, 'yyyyMMdd');

    $http({
	url: url,
	method: 'GET'
    })
    .success(successFunction)
    .error(function(data, status, header,config){
	console.debug('http error');
    });
  }

  this.add = function(lines) {
    this.list.push({
      id: String(this.list.length + 1)
      , createdAt: Date.now()
      , lines: lines
    });
  }

  this.get = function(id) {
    var list = this.list;
    var index = list.length;
    var sheet;

    while(index--) {
      sheet = list[index];
	
      if (sheet.id == id) {
	return sheet;  
      }
    }

    return null;
  }
}])
;
