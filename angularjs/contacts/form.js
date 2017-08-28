app.controller("ComZeappsContactContactsFormCtrl", ["$scope", "$route", "$routeParams", "$location", "$rootScope", "zeapps_modal", "zeHttp",
	function ($scope, $route, $routeParams, $location, $rootScope, zeapps_modal, zhttp) {

        var currentTab = 'general';

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

        $scope.statesHttp = zhttp.app.states;
        $scope.statesFields = [
            {label:'Code ISO',key:'iso_code'},
            {label:'Etat',key:'name'}
        ];

        $scope.accountingNumberHttp = zhttp.crm.accounting_number;
        $scope.accountingNumberTplNew = '/com_zeapps_crm/accounting_numbers/form_modal/';
        $scope.accountingNumberFields = [
            {label:'Libelle',key:'label'},
            {label:'Numero',key:'number'},
            {label:'Type',key:'type_label'}
        ];

        $scope.isTabActive = isTabActive;
        $scope.setTab = setTab;
        $scope.displayTab = displayTab;

		$scope.loadAccountManager = loadAccountManager;
		$scope.loadCompany = loadCompany;
        $scope.loadCountry = loadCountry;
        $scope.loadState = loadState;
        $scope.loadAccountingNumber = loadAccountingNumber;

        zhttp.contact.contact.context().then(function (response) {
            if (response.status == 200) {
                $scope.account_families = response.data.account_families;
                $scope.topologies = response.data.topologies;

                $scope.$parent.form.id_user_account_manager = $rootScope.user.id;
                $scope.$parent.form.name_user_account_manager =  $rootScope.user.firstname + " " +  $rootScope.user.lastname;
            }
        });
        if($routeParams.id_company !== undefined && $routeParams.id_company !== 0){
            zhttp.contact.company.get($routeParams.id_company).then(function(response){
                if(response.data && response.data != "false"){
                    loadCompany(response.data.company);
                }
            });
        }

        function isTabActive(tab){
            return currentTab === tab ? 'active' : '';
        }

        function setTab(tab){
            return currentTab = tab;
        }

        function displayTab(tab){
            return currentTab === tab;
        }

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

        function loadCountry(country) {
            if (country) {
                $scope.$parent.form.country_id = country.id;
                $scope.$parent.form.country_name = country.name;
            } else {
                $scope.$parent.form.country_id = 0;
                $scope.$parent.form.country_name = "";
            }
        }

        function loadState(state) {
            if (state) {
                $scope.$parent.form.state = state.iso_code;
            } else {
                $scope.$parent.form.state = "";
            }
        }

        function loadAccountingNumber(accounting_number) {
            if (accounting_number) {
                $scope.$parent.form.accounting_number = accounting_number.number;
            } else {
                $scope.$parent.form.accounting_number = "";
            }
        }
	}]);