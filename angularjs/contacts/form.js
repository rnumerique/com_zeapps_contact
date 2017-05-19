app.controller('ComZeappsContactContactsFormListCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal) {

        $scope.$parent.loadMenu("com_ze_apps_sales", "com_zeapps_sales_contact");

        $scope.form = [];

        $scope.loadAccountManager = loadAccountManager;
        $scope.removeAccountManager = removeAccountManager;
        $scope.loadCompany = loadCompany;
        $scope.removeCompany = removeCompany;
        $scope.success = success;
        $scope.cancel = cancel;
        $scope.loadCountryLang = loadCountryLang;
        $scope.removeCountryLang = removeCountryLang;

        // charge la fiche
        if ($routeParams.id && $routeParams.id != 0) {
            $http.get('/com_zeapps_contact/contacts/get/' + $routeParams.id).then(function (response) {
                if (response.status == 200) {
                    $scope.form = response.data;
                    $scope.form.date_of_birth = new Date($scope.form.date_of_birth);
                }
            });
        }

        function loadAccountManager() {
            zeapps_modal.loadModule("com_zeapps_core", "search_user", {}, function(objReturn) {
                if (objReturn) {
                    $scope.form.id_user_account_manager = objReturn.id;
                    $scope.form.name_user_account_manager = objReturn.firstname + ' ' + objReturn.lastname;
                } else {
                    $scope.form.id_user_account_manager = 0;
                    $scope.form.name_user_account_manager = '';
                }
            });
        }

        function removeAccountManager() {
            $scope.form.id_user_account_manager = 0;
            $scope.form.name_user_account_manager = '';
        }

        function loadCompany() {
            zeapps_modal.loadModule("com_zeapps_contact", "search_company", {}, function(objReturn) {
                //console.log(objReturn);
                if (objReturn) {
                    $scope.form.id_company = objReturn.id;
                    $scope.form.name_company = objReturn.company_name;
                } else {
                    $scope.form.id_company = 0;
                    $scope.form.name_company = '';
                }
            });
        }

        function removeCompany() {
            $scope.form.id_company = 0;
            $scope.form.name_company = '';
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


            $http.post('/com_zeapps_contact/contacts/save', $data).then(function (obj) {
                // pour que la page puisse être redirigé
                $location.path("/ng/com_zeapps_contact/contacts");
            });
        }

        function cancel() {
            $location.path("/ng/com_zeapps_contact/contacts");
        }

        function loadCountryLang() {
            zeapps_modal.loadModule("com_zeapps_contact", "search_country_lang", {}, function (objReturn) {

                $scope.form.country_lang_name = objReturn.name;
                $scope.form.country_id = objReturn.id_country;

            });
        }

        function removeCountryLang() {
            $scope.form.country_lang_name = '';

        }

    }]);