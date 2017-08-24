app.controller("ComZeappsContactContactsViewCtrl", ["$scope", "$route", "$routeParams", "$location", "$rootScope", "zeHttp", "zeapps_modal", "zeHooks",
	function ($scope, $route, $routeParams, $location, $rootScope, zhttp, zeapps_modal, zeHooks) {

		$scope.$parent.loadMenu("com_ze_apps_sales", "com_zeapps_sales_contact");

		$scope.$on("comZeappsContact_triggerContactHook", function(){
			$rootScope.$broadcast("comZeappsContact_dataContactHook",
				{
					id_contact: $routeParams.id_contact,
					id_company: $scope.contact.id_company
				}
			);
		});

        $scope.contact = [];

        $scope.templateEdit = "/com_zeapps_contact/contacts/form_modal";
		$scope.hooks = zeHooks.get("comZeappsContact_ContactHook");
        $scope.currentTab = $rootScope.comZeappsContactLastShowTabContact || "summary";

		$scope.setTab = setTab;
        $scope.isTabActive = isTabActive;
        $scope.edit = edit;
        $scope.back = back;

        if ($routeParams.id_contact && $routeParams.id_contact != 0) {
            zhttp.contact.contact.get($routeParams.id_contact).then(function (response) {
                if (response.status == 200) {
                    $scope.contact = response.data.contact;
                    $scope.contact.date_of_birth = new Date($scope.contact.date_of_birth);
                }
            });
        }

		function setTab(tab){
			$rootScope.comZeappsContactLastShowTabContact = tab;
			$scope.currentTab = tab;
		}

		function isTabActive(tab){
			return $scope.currentTab === tab;
		}

		function edit() {
            var formatted_data = angular.toJson($scope.contact);
            zhttp.contact.contact.save(formatted_data);
		}

		function back() {
			$location.path("/ng/com_zeapps_contact/contacts");
		}
	}]);