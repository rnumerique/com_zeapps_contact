app.controller("ComZeappsContactAccountFamiliesConfigCtrl", ["$scope", "$route", "$routeParams", "$location", "$rootScope", "zeHttp", "zeapps_modal", "$uibModal",
	function ($scope, $route, $routeParams, $location, $rootScope, zhttp, zeapps_modal, $uibModal) {

		$scope.$parent.loadMenu("com_ze_apps_config", "com_ze_apps_contact_account_families");

		$scope.form = {};
		$scope.newLine = {};

		$scope.createLine = createLine;
		$scope.cancelLine = cancelLine;
		$scope.delete = del;
		$scope.cancel = cancel;
		$scope.success = success;

		zhttp.contact.account_families.get_all().then(function(response){
			if(response.data && response.data != "false"){
				angular.forEach(response.data, function(account_family){
					account_family.sort = parseInt(account_family.sort);
				});
				$rootScope.account_families = response.data;
				$scope.form.account_families = angular.fromJson(angular.toJson(response.data));
			}
		});

		function createLine(){
			var formatted_data = angular.toJson($scope.newLine);
			zhttp.contact.account_families.save(formatted_data).then(function(response){
				if(response.data && response.data != "false"){
					$scope.newLine.id = response.data;
					$scope.form.account_families.push(angular.fromJson(angular.toJson($scope.newLine)));
					$rootScope.account_families.push($scope.newLine);
					$scope.newLine = {};
				}
			});
		}

		function cancelLine(){
			$scope.newLine = {};
		}

		function del(index){
			var id = $scope.form.account_families[index].id;
			zhttp.contact.account_families.del(id).then(function(response){
				if(response.data && response.data != "false"){
					$scope.form.account_families.splice(index, 1);
					$rootScope.account_families.splice(index, 1);
				}
			});
		}

		function cancel(){
			$scope.form.account_families = angular.fromJson(angular.toJson($rootScope.account_families));
		}

		function success(){
			var formatted_data = angular.toJson($scope.form.account_families);
			zhttp.contact.account_families.save_all(formatted_data).then(function(response){
				if(response.data && response.data != "false"){
					$rootScope.account_families = angular.fromJson(angular.toJson($scope.form.account_families));
				}
			});
		}
	}]);