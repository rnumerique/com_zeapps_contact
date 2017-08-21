app.controller("ComZeappsContactContactsViewCtrl", ["$scope", "$route", "$routeParams", "$location", "$rootScope", "zeHttp", "zeapps_modal", "zeHooks",
	function ($scope, $route, $routeParams, $location, $rootScope, zhttp, zeapps_modal, zeHooks) {

		$scope.$parent.loadMenu("com_ze_apps_sales", "com_zeapps_sales_contact");

		$scope.$on("comZeappsContact_triggerContactHook", function(){
			$rootScope.$broadcast("comZeappsContact_dataContactHook",
				{
					id_contact: $routeParams.id,
					id_company: $scope.form.id_company
				}
			);
		});

        $scope.form = [];

        $scope.templateEdit = "/com_zeapps_contact/contacts/form_modal";
		$scope.hooks = zeHooks.get("comZeappsContact_ContactHook");
        $scope.currentTab = $rootScope.comZeappsContactLastShowTabContact || "summary";

		$scope.setTab = setTab;
        $scope.isTabActive = isTabActive;
        $scope.edit = edit;
        $scope.back = back;

        if ($routeParams.id && $routeParams.id != 0) {
            zhttp.contact.contact.get($routeParams.id).then(function (response) {
                if (response.status == 200) {
                    $scope.form = response.data.contact;
                    $scope.form.date_of_birth = new Date($scope.form.date_of_birth);
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
            var formatted_data = angular.toJson($scope.form);
            zhttp.contact.contact.save(formatted_data);
		}

		function back() {
			$location.path("/ng/com_zeapps_contact/contacts");
		}
	}]);