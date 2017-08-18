app.controller("ComZeappsContactContactsFormListCtrl", ["$scope", "$route", "$routeParams", "$location", "$rootScope", "$http", "zeapps_modal", "zeHttp",
	function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal, zhttp) {

		$scope.$parent.loadMenu("com_ze_apps_sales", "com_zeapps_sales_contact");

		$scope.form = [];

        $scope.accountManagerHttp = zhttp.app.user.modal;
        $scope.accountManagerFields = [
            {label:'Prénom',key:'firstname'},
            {label:'Nom',key:'lastname'}
        ];

        $scope.companyHttp = zhttp.contact.company.modal;
        $scope.companyFields = [
            {label:'Nom',key:'company_name'},
            {label:'Téléphone',key:'phone'},
            {label:'Ville',key:'billing_city'},
            {label:'Gestionnaire du compte',key:'name_user_account_manager'}
        ];

        $scope.countriesHttp = zhttp.app.countries.modal;
        $scope.countriesFields = [
            {label:'Code ISO',key:'iso_code'},
            {label:'Pays',key:'name'}
        ];

		$scope.loadAccountManager = loadAccountManager;
		$scope.loadCompany = loadCompany;
        $scope.loadCountry = loadCountry;
		$scope.success = success;
		$scope.cancel = cancel;

		// charge la fiche
		if ($routeParams.id && $routeParams.id != 0) {
			$http.get("/com_zeapps_contact/contacts/get/" + $routeParams.id).then(function (response) {
				if (response.status == 200) {
					$scope.form = response.data.contact;
					$scope.account_families = response.data.account_families;
					$scope.topologies = response.data.topologies;
					$scope.form.date_of_birth = new Date($scope.form.date_of_birth);
				}
			});
		}
		else{
			$http.get("/com_zeapps_contact/contacts/context/").then(function (response) {
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

        function loadCompany(company) {
            if (company) {
                $scope.form.id_company = company.id;
                $scope.form.name_company = company.company_name;
            } else {
                $scope.form.id_company = 0;
                $scope.form.name_company = "";
            }
        }

		function success() {
			var $data = {} ;

			if ($routeParams.id != 0) {
				$data.id = $routeParams.id;
			}

			$data.id_user_account_manager = $scope.form.id_user_account_manager ;
			$data.name_user_account_manager = $scope.form.name_user_account_manager ;
			$data.id_company = $scope.form.id_company ;
			$data.name_company = $scope.form.name_company ;
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
			$data.title_name = $scope.form.title_name ;
			$data.first_name = $scope.form.first_name ;
			$data.last_name = $scope.form.last_name ;
			$data.email = $scope.form.email ;
			$data.phone = $scope.form.phone ;
			$data.other_phone = $scope.form.other_phone ;
			$data.mobile = $scope.form.mobile ;
			$data.fax = $scope.form.fax ;
			$data.assistant = $scope.form.assistant ;
			$data.assistant_phone = $scope.form.assistant_phone ;
			$data.department = $scope.form.department ;
			$data.job = $scope.form.job ;
			$data.email_opt_out = $scope.form.email_opt_out ;
			$data.skype_id = $scope.form.skype_id ;
			$data.twitter = $scope.form.twitter ;
			if($scope.form.date_of_birth) {
				var y = $scope.form.date_of_birth.getFullYear();
				var M = $scope.form.date_of_birth.getMonth();
				var d = $scope.form.date_of_birth.getDate();

				var date = new Date(Date.UTC(y, M, d));

				$data.date_of_birth = date;
			}
			$data.address_1 = $scope.form.address_1 ;
			$data.address_2 = $scope.form.address_2 ;
			$data.address_3 = $scope.form.address_3 ;
			$data.city = $scope.form.city ;
			$data.zipcode = $scope.form.zipcode ;
			$data.state = $scope.form.state ;
			$data.country_id = $scope.form.country_id ;
			$data.country_name = $scope.form.country_lang_name ;
			$data.comment = $scope.form.comment ;
			$data.website_url = $scope.form.website_url ;
			$data.accounting_number = $scope.form.accounting_number ;


			$http.post("/com_zeapps_contact/contacts/save", $data).then(function (response) {
				if(response.data && response.data != "false"){
					$location.path("/ng/com_zeapps_contact/contacts/" + response.data);
				}
			});
		}

		function cancel() {
			$location.path("/ng/com_zeapps_contact/contacts");
		}

        function loadCountry(code_naf) {
            if (code_naf) {
                $scope.form.country_id = code_naf.id;
                $scope.form.country_name = code_naf.name;
            } else {
                $scope.form.country_id = 0;
                $scope.form.country_name = "";
            }
        }



	}]);