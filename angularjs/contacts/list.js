app.controller("ComZeappsContactContactsListCtrl", ["$scope", "$route", "$routeParams", "$location", "$rootScope", "$http", "$uibModal", "zeapps_modal",
	function ($scope, $route, $routeParams, $location, $rootScope, $http, $uibModal, zeapps_modal) {

		$scope.$parent.loadMenu("com_ze_apps_sales", "com_zeapps_sales_contact");

		$scope.filters = {
			id_account_family : "none",
			id_topology : "none"
		};
		$scope.contacts = [];
		$scope.page = 1;
		$scope.pageSize = 30;

		$scope.loadCountryLang = loadCountryLang;
		$scope.removeCountryLang = removeCountryLang;
		$scope.delete = del;

		loadList() ;

		function loadList() {
			var options = {};
			$http.post("/com_zeapps_contact/contacts/getAll", options).then(function (response) {
				if (response.status == 200) {
					$scope.contacts = response.data.contacts ;
					$scope.topologies = response.data.topologies ;
					$scope.account_families = response.data.account_families ;
				}
			});
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
						return "Souhaitez-vous supprimer définitivement ce contact ?";
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
					$http.get("/com_zeapps_contact/contacts/delete/" + argIdUser).then(function (response) {
						if (response.status == 200) {
							loadList() ;
						}
					});
				}

			}, function () {
			});

		}


	}]);