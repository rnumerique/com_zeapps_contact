app.controller("ComZeappsContactContactsFormListCtrl", ["$scope", "$route", "$routeParams", "$location", "$rootScope", "$http", "zeapps_modal", "zeHttp",
	function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal, zhttp) {

        $scope.accountManagerHttp = zhttp.app.user;
        $scope.accountManagerFields = [
            {label:'Prénom',key:'firstname'},
            {label:'Nom',key:'lastname'}
        ];

        $scope.companyHttp = zhttp.contact.company;
        $scope.companyFields = [
            {label:'Nom',key:'company_name'},
            {label:'Téléphone',key:'phone'},
            {label:'Ville',key:'billing_city'},
            {label:'Gestionnaire du compte',key:'name_user_account_manager'}
        ];

        $scope.countriesHttp = zhttp.app.countries;
        $scope.countriesFields = [
            {label:'Code ISO',key:'iso_code'},
            {label:'Pays',key:'name'}
        ];

		$scope.loadAccountManager = loadAccountManager;
		$scope.loadCompany = loadCompany;
        $scope.loadCountry = loadCountry;

        $http.get("/com_zeapps_contact/contacts/context/").then(function (response) {
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

        function loadCompany(company) {
            if (company) {
                $scope.$parent.form.id_company = company.id;
                $scope.$parent.form.name_company = company.company_name;
            } else {
                $scope.$parent.form.id_company = 0;
                $scope.$parent.form.name_company = "";
            }
        }

        function loadCountry(code_naf) {
            if (code_naf) {
                $scope.$parent.form.country_id = code_naf.id;
                $scope.$parent.form.country_name = code_naf.name;
            } else {
                $scope.$parent.form.country_id = 0;
                $scope.$parent.form.country_name = "";
            }
        }



	}]);