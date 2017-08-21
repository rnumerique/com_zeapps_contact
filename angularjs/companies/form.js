app.controller("ComZeappsContactCompaniesFormListCtrl", ["$scope", "$route", "$routeParams", "$location", "$rootScope", "$http", "zeapps_modal", "zeHttp",
	function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal, zhttp) {

		$scope.accountManagerHttp = zhttp.app.user;
		$scope.accountManagerFields = [
			{label:'Prénom',key:'firstname'},
			{label:'Nom',key:'lastname'}
		];

		$scope.parentCompanyHttp = zhttp.contact.company;
		$scope.parentCompanyFields = [
			{label:'Nom',key:'company_name'},
			{label:'Téléphone',key:'phone'},
			{label:'Ville',key:'billing_city'},
			{label:'Gestionnaire du compte',key:'name_user_account_manager'}
		];

		$scope.codeNafHttp = zhttp.contact.code_naf;
		$scope.codeNafFields = [
			{label:'Code NAF',key:'code_naf'},
			{label:'Libellé',key:'libelle'}
		];

		$scope.countriesHttp = zhttp.app.countries;
		$scope.countriesFields = [
			{label:'Code ISO',key:'iso_code'},
			{label:'Pays',key:'name'}
		];

		$scope.loadAccountManager = loadAccountManager;
		$scope.loadParentCompany = loadParentCompany;
		$scope.loadCodeNaf = loadCodeNaf;
		$scope.loadCountryDelivery = loadCountryDelivery;
		$scope.loadCountryBilling = loadCountryBilling;

        $http.get("/com_zeapps_contact/companies/context/").then(function (response) {
            if (response.status == 200) {
                $scope.account_families = response.data.account_families;
                $scope.topologies = response.data.topologies;

                $scope.$parent.form.id_user_account_manager = $rootScope.user.id;
                $scope.$parent.form.name_user_account_manager =  $rootScope.user.firstname + " " +  $rootScope.user.lastname;
            }
        });


		function loadAccountManager(user) {
            if (user) {
                $scope.$parent.form.id_user_account_manager = user.id;
                $scope.$parent.form.name_user_account_manager = user.firstname + " " + user.lastname;
            } else {
                $scope.$parent.form.id_user_account_manager = 0;
                $scope.$parent.form.name_user_account_manager = "";
            }
		}

		function loadParentCompany(company) {
            if (company) {
                $scope.$parent.form.id_parent_company = company.id;
                $scope.$parent.form.name_parent_company = company.company_name;
            } else {
                $scope.$parent.form.id_parent_company = 0;
                $scope.$parent.form.name_parent_company = "";
            }
		}

		function loadCodeNaf(code_naf) {
            if (code_naf) {
                $scope.$parent.form.code_naf = code_naf.code_naf;
                $scope.$parent.form.code_naf_libelle = code_naf.libelle;
            } else {
                $scope.$parent.form.code_naf = 0;
                $scope.$parent.form.code_naf_libelle = "";
            }
		}

		function loadCountryDelivery(code_naf) {
            if (code_naf) {
                $scope.$parent.form.delivery_country_id = code_naf.id;
                $scope.$parent.form.delivery_country_name = code_naf.name;
            } else {
                $scope.$parent.form.delivery_country_id = 0;
                $scope.$parent.form.delivery_country_name = "";
            }
		}

		function loadCountryBilling(code_naf) {
            if (code_naf) {
                $scope.$parent.form.billing_country_id = code_naf.id;
                $scope.$parent.form.billing_country_name = code_naf.name;
            } else {
                $scope.$parent.form.billing_country_id = 0;
                $scope.$parent.form.billing_country_name = "";
            }
		}
	}]);