app.controller("ComZeappsContactTopologiesConfigCtrl", ["$scope", "$route", "$routeParams", "$location", "$rootScope", "zeHttp", "zeapps_modal", "$uibModal",
	function ($scope, $route, $routeParams, $location, $rootScope, zhttp, zeapps_modal, $uibModal) {

		$scope.$parent.loadMenu("com_ze_apps_config", "com_ze_apps_contact_topologies");

		$scope.form = {};
		$scope.newLine = {};

		$scope.createLine = createLine;
		$scope.cancelLine = cancelLine;
		$scope.delete = del;
		$scope.cancel = cancel;
		$scope.success = success;

		zhttp.contact.topologies.get_all().then(function(response){
			if(response.data && response.data != "false"){
				angular.forEach(response.data, function(topology){
					topology.sort = parseInt(topology.sort);
				});
				$rootScope.topologies = response.data;
				$scope.form.topologies = angular.fromJson(angular.toJson(response.data));
			}
		});

		function createLine(){
			var formatted_data = angular.toJson($scope.newLine);
			zhttp.contact.topologies.save(formatted_data).then(function(response){
				if(response.data && response.data != "false"){
					$scope.newLine.id = response.data;
					$scope.form.topologies.push(angular.fromJson(angular.toJson($scope.newLine)));
					$rootScope.topologies.push($scope.newLine);
					$scope.newLine = {};
				}
			});
		}

		function cancelLine(){
			$scope.newLine = {};
		}

		function del(index){
			var id = $scope.form.topologies[index].id;
			zhttp.contact.topologies.del(id).then(function(response){
				if(response.data && response.data != "false"){
					$scope.form.topologies.splice(index, 1);
					$rootScope.topologies.splice(index, 1);
				}
			});
		}

		function cancel(){
			$scope.form.topologies = angular.fromJson(angular.toJson($rootScope.topologies));
		}

		function success(){
			var formatted_data = angular.toJson($scope.form.topologies);
			zhttp.contact.topologies.save_all(formatted_data).then(function(response){
				if(response.data && response.data != "false"){
					$rootScope.topologies = angular.fromJson(angular.toJson($scope.form.topologies));
				}
			});
		}
	}]);