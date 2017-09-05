app.controller("ComZeappsContactTopologiesConfigCtrl", ["$scope", "$route", "$routeParams", "$location", "$rootScope", "zeHttp", "zeapps_modal", "$uibModal",
	function ($scope, $route, $routeParams, $location, $rootScope, zhttp, zeapps_modal, $uibModal) {

		$scope.$parent.loadMenu("com_ze_apps_config", "com_ze_apps_contact_topologies");

        $scope.templateForm = "/com_zeapps_contact/topologies/form_modal";

        $scope.add = add;
        $scope.edit = edit;
		$scope.delete = del;

        function add(topology){
            var formatted_data = angular.toJson(topology);
            zhttp.contact.topologies.save(formatted_data).then(function(response){
                if(response.data && response.data != "false"){
                    topology.id = response.data;
                    $rootScope.topologies.push(topology);
                }
            });
        }

        function edit(topology){
            var formatted_data = angular.toJson(topology);
            zhttp.contact.topologies.save(formatted_data);
        }

        function del(topology){
            zhttp.contact.topologies.del(topology.id).then(function(response){
                if(response.data && response.data != "false"){
                    $rootScope.topologies.splice($rootScope.topologies.indexOf(topology), 1);
                }
            });
        }
	}]);