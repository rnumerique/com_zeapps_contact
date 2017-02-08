app.controller('ComZeappsContactCompaniesViewCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal) {

        $scope.$parent.loadMenu("com_ze_apps_sales", "com_zeapps_sales_company");

        var initNavigation = function() {

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


            $scope.first_company = function () {
                if ($scope.company_first != 0) {
                    $location.path("/ng/com_zeapps_contact/companies/" + $scope.company_first);
                }
            };
            $scope.previous_company = function () {
                if ($scope.company_previous != 0) {
                    $location.path("/ng/com_zeapps_contact/companies/" + $scope.company_previous);
                }
            };
            $scope.next_company = function () {
                if ($scope.company_next) {
                    $location.path("/ng/com_zeapps_contact/companies/" + $scope.company_next);
                }
            };
            $scope.last_company = function () {
                if ($scope.company_last) {
                    $location.path("/ng/com_zeapps_contact/companies/" + $scope.company_last);
                }
            };

        };

        if($rootScope.companies_search_list == undefined) {
            $http.post('/com_zeapps_contact/companies/getAll').then(function (response) {
                if (response.status == 200) {
                    $scope.companies = response.data;

                    // stock la liste des compagnies pour la navigation par fleche
                    $rootScope.companies_search_list = response.data;

                    initNavigation();
                }
            });
        }
        else{
            initNavigation();
        }

        /******* gestion de la tabs *********/
        $scope.navigationState = 'summary';
        if ($rootScope.comZeappsContactLastShowTabEntreprise) {
            $scope.navigationState = $rootScope.comZeappsContactLastShowTabEntreprise ;
        }

        // pour détecter les changements sur le models
        $scope.$watch('navigationState', function(scope){
            $rootScope.comZeappsContactLastShowTabEntreprise = $scope.navigationState ;
        }, true);
        /******* FIN : gestion de la tabs *********/




        $scope.form = [];
        $scope.quotes = [];

        // charge la fiche
        if ($routeParams.id && $routeParams.id != 0) {
            $http.get('/com_zeapps_contact/companies/get/' + $routeParams.id).then(function (response) {
                if (response.status == 200) {
                    $scope.form = response.data;
                }
            });
            $http.get('/com_zeapps_crm/quotes/getAll/' + $routeParams.id).then(function(response){
                if(response.data && response.data != 'false'){
                    $scope.quotes = response.data;
                    for(var i=0; i<$scope.quotes.length; i++){
                        $scope.quotes[i].date_creation = new Date($scope.quotes[i].date_creation);
                        $scope.quotes[i].date_limit = new Date($scope.quotes[i].date_limit);
                    }
                }
            })
        }

        $scope.edit = function () {
            var urlRetour = "/ng/com_zeapps_contact/companies/" + $routeParams.id ;

            $location.path("/ng/com_zeapps_contact/companies/" + $routeParams.id + "/edit/retour/" + encodeURI(urlRetour.replace(/\//g,charSepUrlSlash)));
        };

        $scope.cancel = function () {
            $location.path("/ng/com_zeapps_contact/companies");
        };






        $scope.totalHT = function(quote){

            var total = 0;
            for(var i = 0; i < quote.lines.length; i++){
                if(quote.lines[i] != undefined && quote.lines[i].num != 'subTotal' && quote.lines[i].num != 'comment'){
                    total += quote.lines[i].price_unit * quote.lines[i].qty * ( 1 - (quote.lines[i].discount / 100) );
                }
            }
            total = total * (1- (quote.global_discount / 100) );
            return total;

        };

        $scope.totalTTC = function(quote){

            var total = 0;
            for(var i = 0; i < quote.lines.length; i++){
                if(quote.lines[i] != undefined && quote.lines[i].num != 'subTotal' && quote.lines[i].num != 'comment'){
                    total += quote.lines[i].price_unit * quote.lines[i].qty * ( 1 - (quote.lines[i].discount / 100) ) * ( 1 + (quote.lines[i].taxe / 100) );
                }
            }
            total = total * (1- (quote.global_discount / 100) );
            return total;

        };




    }]);