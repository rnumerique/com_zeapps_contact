app.controller("ComZeappsContactCompaniesFormListCtrl", ["$scope", "$route", "$routeParams", "$location", "$rootScope", "$http", "zeapps_modal", "zeHttp",
	function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal, zhttp) {

		$scope.$parent.loadMenu("com_ze_apps_sales", "com_zeapps_sales_company");

		$scope.form = [];

		$scope.accountManagerHttp = zhttp.app.user.modal;
		$scope.accountManagerFields = [
			{label:'Prénom',key:'firstname'},
			{label:'Nom',key:'lastname'}
		];

		$scope.parentCompanyHttp = zhttp.contact.company.modal;
		$scope.parentCompanyFields = [
			{label:'Nom',key:'company_name'},
			{label:'Téléphone',key:'phone'},
			{label:'Ville',key:'billing_city'},
			{label:'Gestionnaire du compte',key:'name_user_account_manager'}
		];

		$scope.codeNafHttp = zhttp.contact.code_naf.modal;
		$scope.codeNafFields = [
			{label:'Code NAF',key:'code_naf'},
			{label:'Libellé',key:'libelle'}
		];

		$scope.countriesHttp = zhttp.app.countries.modal;
		$scope.countriesFields = [
			{label:'Code ISO',key:'iso_code'},
			{label:'Pays',key:'name'}
		];

		$scope.loadAccountManager = loadAccountManager;
		$scope.loadParentCompany = loadParentCompany;
		$scope.loadCodeNaf = loadCodeNaf;
		$scope.loadCountryDelivery = loadCountryDelivery;
		$scope.loadCountryBilling = loadCountryBilling;
		$scope.success = success;
		$scope.cancel = cancel;

		// charge la fiche
		if ($routeParams.id && $routeParams.id != 0) {
			$http.get("/com_zeapps_contact/companies/get/" + $routeParams.id).then(function (response) {
				if (response.status == 200) {
					$scope.form = response.data.company;
					$scope.account_families = response.data.account_families;
					$scope.topologies = response.data.topologies;
				}
			});
		}
		else{
			$http.get("/com_zeapps_contact/companies/context/").then(function (response) {
				if (response.status == 200) {
					$scope.account_families = response.data.account_families;
					$scope.topologies = response.data.topologies;

                    $scope.form.id_user_account_manager = $rootScope.user.id;
                    $scope.form.name_user_account_manager =  $rootScope.user.firstname + " " +  $rootScope.user.lastname;
				}
			});
		}


		function loadAccountManager(user) {
            if (user) {
                $scope.form.id_user_account_manager = user.id;
                $scope.form.name_user_account_manager = user.firstname + " " + user.lastname;
            } else {
                $scope.form.id_user_account_manager = 0;
                $scope.form.name_user_account_manager = "";
            }
		}

		function loadParentCompany(company) {
            if (company) {
                $scope.form.id_parent_company = company.id;
                $scope.form.name_parent_company = company.company_name;
            } else {
                $scope.form.id_parent_company = 0;
                $scope.form.name_parent_company = "";
            }
		}

		function loadCodeNaf(code_naf) {
            if (code_naf) {
                $scope.form.code_naf = code_naf.code_naf;
                $scope.form.code_naf_libelle = code_naf.libelle;
            } else {
                $scope.form.code_naf = 0;
                $scope.form.code_naf_libelle = "";
            }
		}

		function loadCountryDelivery(code_naf) {
            if (code_naf) {
                $scope.form.delivery_country_id = code_naf.id;
                $scope.form.delivery_country_name = code_naf.name;
            } else {
                $scope.form.delivery_country_id = 0;
                $scope.form.delivery_country_name = "";
            }
		}

		function loadCountryBilling(code_naf) {
            if (code_naf) {
                $scope.form.billing_country_id = code_naf.id;
                $scope.form.billing_country_name = code_naf.name;
            } else {
                $scope.form.billing_country_id = 0;
                $scope.form.billing_country_name = "";
            }
		}

		function success() {
			var $data = {};

			if ($routeParams.id != 0) {
				$data.id = $routeParams.id;
			}

			$data.id_user_account_manager = $scope.form.id_user_account_manager;
			$data.name_user_account_manager = $scope.form.name_user_account_manager;
			$data.company_name = $scope.form.company_name;
			$data.id_parent_company = $scope.form.id_parent_company;
			$data.name_parent_company = $scope.form.name_parent_company;
			$data.id_account_family = $scope.form.id_account_family;
			angular.forEach($scope.account_families, function(account_family){
				if(account_family.id === $data.id_account_family){
					$data.name_account_family = account_family.label;
				}
			});
			$data.id_topology = $scope.form.id_topology;
			angular.forEach($scope.topologies, function(topology){
				if(topology.id === $data.id_topology){
					$data.name_topology = topology.label;
				}
			});
			$data.id_activity_area = $scope.form.id_activity_area;
			$data.name_activity_area = $scope.form.name_activity_area;
			$data.turnover = $scope.form.turnover;
			$data.billing_address_1 = $scope.form.billing_address_1;
			$data.billing_address_2 = $scope.form.billing_address_2;
			$data.billing_address_3 = $scope.form.billing_address_3;
			$data.billing_city = $scope.form.billing_city;
			$data.billing_zipcode = $scope.form.billing_zipcode;
			$data.billing_state = $scope.form.billing_state;
			$data.billing_country_id = $scope.form.billing_country_id;
			$data.billing_country_name = $scope.form.billing_country_name;
			$data.delivery_address_1 = $scope.form.delivery_address_1;
			$data.delivery_address_2 = $scope.form.delivery_address_2;
			$data.delivery_address_3 = $scope.form.delivery_address_3;
			$data.delivery_city = $scope.form.delivery_city;
			$data.delivery_zipcode = $scope.form.delivery_zipcode;
			$data.delivery_state = $scope.form.delivery_state;
			$data.delivery_country_id = $scope.form.delivery_country_id;
			$data.delivery_country_name = $scope.form.delivery_country_name;
			$data.comment = $scope.form.comment;
			$data.phone = $scope.form.phone;
			$data.fax = $scope.form.fax;
			$data.website_url = $scope.form.website_url;
			$data.code_naf = $scope.form.code_naf;
			$data.code_naf_libelle = $scope.form.code_naf_libelle;
			$data.company_number = $scope.form.company_number;
			$data.accounting_number = $scope.form.accounting_number;


			$http.post("/com_zeapps_contact/companies/save", $data).then(function (obj) {
				// pour que la page puisse être redirigé
				if ($routeParams.url_retour) {
					$location.path($routeParams.url_retour.replace(charSepUrlSlashRegExp,"/"));
				} else {
					$location.path("/ng/com_zeapps_contact/companies");
				}
			});
		}

		function cancel() {
			if ($routeParams.url_retour) {
				$location.path($routeParams.url_retour.replace(charSepUrlSlashRegExp,"/"));
			} else {
				$location.path("/ng/com_zeapps_contact/companies");
			}
		}

	}]);