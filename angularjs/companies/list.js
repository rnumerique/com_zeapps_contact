app.controller('ComZeappsContactCompaniesListCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', '$uibModal', 'zeapps_modal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, $uibModal, zeapps_modal) {

        $scope.$parent.loadMenu("com_ze_apps_sales", "com_zeapps_sales_company");

        $scope.filters = {
            id_type_account : 'none'
        };
        $scope.companies = [];
        $scope.page = 1;
        $scope.pageSize = 30;

        var loadList = function () {
            $http.post('/com_zeapps_contact/companies/getAll').then(function (response) {
                if (response.status == 200) {
                    $scope.companies = response.data ;

                    // stock la liste des compagnies pour la navigation par fleche
                    $rootScope.companies_search_list = response.data ;
                }
            });
        };
        loadList() ;

        $scope.loadCodeNaf = function () {
            zeapps_modal.loadModule("com_zeapps_contact", "search_code_naf", {}, function(objReturn) {
                if (objReturn) {
                    $scope.filters.code_naf = objReturn.code_naf;
                    $scope.filters.code_naf_libelle = objReturn.code_naf + " - " + objReturn.libelle;
                } else {
                    $scope.filters.code_naf = '';
                    $scope.filters.code_naf_libelle = '';
                }
            });
        };

        $scope.removeCodeNaf = function() {
            delete $scope.filters.code_naf;
            $scope.filters.code_naf_libelle = '';
        };

        $scope.loadCountryLang = function () {
            zeapps_modal.loadModule("com_zeapps_contact", "search_country_lang", {}, function (objReturn) {
                $scope.filters.country_lang_name = objReturn.name;
                $scope.filters.country_id = objReturn.id_country;
            });
        };

        $scope.removeCountryLang = function() {
            $scope.filters.country_lang_name = '';
            $scope.filters.country_id = 0;

        };



        $scope.delete = function (argIdUser) {
            var modalInstance = $uibModal.open({
                animation: true,
                templateUrl: '/assets/angular/popupModalDeBase.html',
                controller: 'ZeAppsPopupModalDeBaseCtrl',
                size: 'lg',
                resolve: {
                    titre: function () {
                        return 'Attention';
                    },
                    msg: function () {
                        return 'Souhaitez-vous supprimer définitivement cette entreprise ?';
                    },
                    action_danger: function () {
                        return 'Annuler';
                    },
                    action_primary: function () {
                        return false;
                    },
                    action_success: function () {
                        return 'Je confirme la suppression';
                    }
                }
            });

            modalInstance.result.then(function (selectedItem) {
                if (selectedItem.action == 'danger') {

                } else if (selectedItem.action == 'success') {
                    $http.get('/com_zeapps_contact/companies/delete/' + argIdUser).then(function (response) {
                        if (response.status == 200) {
                            loadList() ;
                        }
                    });
                }

            }, function () {
                //console.log("rien");
            });

        };


    }]);