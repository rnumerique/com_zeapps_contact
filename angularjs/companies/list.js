app.controller("ComZeappsContactCompaniesListCtrl", ["$scope", "$route", "$routeParams", "$location", "$rootScope", "$http", "$uibModal", "zeapps_modal",
	function ($scope, $route, $routeParams, $location, $rootScope, $http, $uibModal, zeapps_modal) {

		$scope.$parent.loadMenu("com_ze_apps_sales", "com_zeapps_sales_company");

		$scope.filter = {
			model: {},
			options: {
				main: [
					{
						format: 'input',
						field: 'nom',
						type: 'text',
						label: 'Nom'
					},
					{
						format: 'select',
						field: 'id_account_family',
						type: 'text',
						label: 'Famille',
						options: []
					},
					{
						format: 'select',
						field: 'id_topology',
						type: 'text',
						label: 'Topologie',
						options: []
					}
				],
				secondaries: [
					{
						format: 'input',
						field: 'nom',
						type: 'text',
						label: 'Ville',
						size: 6
					},
					{
						format: 'input',
						field: 'nom',
						type: 'text',
						label: 'Code Postal',
						size: 6
					}
				]
			}
		};
		$scope.companies = [];
		$scope.page = 1;
		$scope.pageSize = 30;

		$scope.loadCodeNaf = loadCodeNaf;
		$scope.removeCodeNaf = removeCodeNaf;
		$scope.loadCountryLang = loadCountryLang;
		$scope.removeCountryLang = removeCountryLang;
		$scope.delete = del;

		loadList() ;

		function loadList() {
			$http.post("/com_zeapps_contact/companies/getAll").then(function (response) {
				if (response.status == 200) {
					$scope.companies = response.data.companies ;
					$scope.filter.options.main[1].options = response.data.account_families;
					$scope.filter.options.main[2].options = response.data.topologies;

					// stock la liste des compagnies pour la navigation par fleche
					$rootScope.companies_search_list = response.data.companies ;
				}
			});
		}
		function loadCodeNaf() {
			zeapps_modal.loadModule("com_zeapps_contact", "search_code_naf", {}, function(objReturn) {
				if (objReturn) {
					$scope.filters.code_naf = objReturn.code_naf;
					$scope.filters.code_naf_libelle = objReturn.code_naf + " - " + objReturn.libelle;
				} else {
					$scope.filters.code_naf = "";
					$scope.filters.code_naf_libelle = "";
				}
			});
		}

		function removeCodeNaf() {
			delete $scope.filters.code_naf;
			$scope.filters.code_naf_libelle = "";
		}

		function loadCountryLang() {
			zeapps_modal.loadModule("com_zeapps_contact", "search_country_lang", {}, function (objReturn) {
				$scope.filters.country_lang_name = objReturn.name;
				$scope.filters.country_id = objReturn.id_country;
			});
		}

		function removeCountryLang() {
			$scope.filters.country_lang_name = "";
			$scope.filters.country_id = 0;

		}



		function del(argIdUser) {
			var modalInstance = $uibModal.open({
				animation: true,
				templateUrl: "/assets/angular/popupModalDeBase.html",
				controller: "ZeAppsPopupModalDeBaseCtrl",
				size: "lg",
				resolve: {
					titre: function () {
						return "Attention";
					},
					msg: function () {
						return "Souhaitez-vous supprimer définitivement cette entreprise ?";
					},
					action_danger: function () {
						return "Annuler";
					},
					action_primary: function () {
						return false;
					},
					action_success: function () {
						return "Je confirme la suppression";
					}
				}
			});

			modalInstance.result.then(function (selectedItem) {
				if (selectedItem.action == "danger") {

				} else if (selectedItem.action == "success") {
					$http.get("/com_zeapps_contact/companies/delete/" + argIdUser).then(function (response) {
						if (response.status == 200) {
							loadList() ;
						}
					});
				}

			}, function () {
			});

		}


	}]);