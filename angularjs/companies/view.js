app.controller("ComZeappsContactCompaniesViewCtrl", ["$scope", "$route", "$routeParams", "$location", "$rootScope", "zeHttp", "zeapps_modal", "zeHooks",
	function ($scope, $route, $routeParams, $location, $rootScope, zhttp, zeapps_modal, zeHooks) {

		$scope.$parent.loadMenu("com_ze_apps_sales", "com_zeapps_sales_company");

		$scope.$on("comZeappsContact_triggerEntrepriseHook", function(event, data){
			$rootScope.$broadcast("comZeappsContact_dataEntrepriseHook",
				{
					id_company: $routeParams.id
				}
			);
		});

        $scope.templateEdit = "/com_zeapps_contact/companies/form_modal";
		$scope.hooks = zeHooks.get("comZeappsContact_EntrepriseHook");
		$scope.company = [];

        $scope.currentTab = $rootScope.comZeappsContactLastShowTabEntreprise || "summary";

		$scope.setTab = setTab;
		$scope.isTabActive = isTabActive;

		$scope.first_company = first_company;
		$scope.previous_company = previous_company;
		$scope.next_company = next_company;
		$scope.last_company = last_company;

		$scope.edit = edit;
		$scope.back = back;

		// charge la fiche
		if ($routeParams.id && $routeParams.id != 0) {
			zhttp.contact.company.get($routeParams.id).then(function (response) {
				if (response.status == 200) {
					$scope.company = response.data.company;
					$scope.contacts = response.data.contacts;
				}
			});
		}

		if($rootScope.companies_search_list == undefined) {
            zhttp.contact.company.all(0, 0, "").then(function (response) {
				if (response.status == 200) {
					$scope.companies = response.data.companies;

					// stock la liste des compagnies pour la navigation par fleche
					$rootScope.companies_search_list = response.data.companies;

					initNavigation();
				}
			});
		}
		else{
			initNavigation();
		}

		function setTab(tab){
			$rootScope.comZeappsContactLastShowTabEntreprise = tab;
			$scope.currentTab = tab;
		}

		function isTabActive(tab){
			return $scope.currentTab === tab;
		}

		function edit() {
            var formatted_data = angular.toJson($scope.company);
            zhttp.contact.company.save(formatted_data);
		}

		function back() {
			$location.path("/ng/com_zeapps_contact/companies");
		}

		function initNavigation() {

			// calcul le nombre de résultat
			$scope.nb_companies = $rootScope.companies_search_list.length;


			// calcul la position du résultat actuel
			$scope.companie_order = 0;
			$scope.company_first = 0;
			$scope.company_previous = 0;
			$scope.company_next = 0;
			$scope.company_last = 0;

			for (var i = 0; i < $rootScope.companies_search_list.length; i++) {
				if ($rootScope.companies_search_list[i].id == $routeParams.id) {
					$scope.companie_order = i + 1;
					if (i > 0) {
						$scope.company_previous = $rootScope.companies_search_list[i - 1].id;
					}

					if ((i + 1) < $rootScope.companies_search_list.length) {
						$scope.company_next = $rootScope.companies_search_list[i + 1].id;
					}
				}
			}

			// recherche la première companie de la liste
			if ($rootScope.companies_search_list[0].id != $routeParams.id) {
				$scope.company_first = $rootScope.companies_search_list[0].id;
			}

			// recherche la dernière companie de la liste
			if ($rootScope.companies_search_list[$rootScope.companies_search_list.length - 1].id != $routeParams.id) {
				$scope.company_last = $rootScope.companies_search_list[$rootScope.companies_search_list.length - 1].id;
			}
		}

        function first_company() {
            if ($scope.company_first !== 0) {
                $location.path("/ng/com_zeapps_contact/companies/" + $scope.company_first);
            }
        }
        function previous_company() {
            if ($scope.company_previous !== 0) {
                $location.path("/ng/com_zeapps_contact/companies/" + $scope.company_previous);
            }
        }
        function next_company() {
            if ($scope.company_next) {
                $location.path("/ng/com_zeapps_contact/companies/" + $scope.company_next);
            }
        }
        function last_company() {
            if ($scope.company_last) {
                $location.path("/ng/com_zeapps_contact/companies/" + $scope.company_last);
            }
        }




	}]);