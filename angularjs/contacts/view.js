app.controller('ComZeappsContactContactsViewCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal', 'zeHooks',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal, zeHooks) {

        $scope.$parent.loadMenu("com_ze_apps_sales", "com_zeapps_sales_contact");

        $scope.$on('comZeappsContact_triggerContactHook', function(event, data){
            $rootScope.$broadcast('comZeappsContact_dataContactHook',
                {
                    id_contact: $routeParams.id,
                    id_company: $scope.form.id_company
                }
            );
        });

        $scope.hooks = zeHooks.get('comZeappsContact_ContactHook');

        /******* gestion de la tabs *********/
        $scope.currentTab = 'summary';
        if ($rootScope.comZeappsContactLastShowTabContact) {
            $scope.currentTab = $rootScope.comZeappsContactLastShowTabContact ;
        }

        $scope.setTab = function(tab){
            $rootScope.comZeappsContactLastShowTabContact = tab;
            $scope.currentTab = tab;
        };

        $scope.isTabActive = function(tab){
            return $scope.currentTab === tab;
        };
        /******* FIN : gestion de la tabs *********/




        $scope.form = [];

        // charge la fiche
        if ($routeParams.id && $routeParams.id != 0) {
            $http.get('/com_zeapps_contact/contacts/get/' + $routeParams.id).then(function (response) {
                if (response.status == 200) {
                    $scope.form = response.data;
                }
            });
        }

        $scope.edit = function () {
            var urlRetour = "/ng/com_zeapps_contact/contacts/" + $routeParams.id ;

            $location.path("/ng/com_zeapps_contact/contacts/" + $routeParams.id + "/edit/retour/" + encodeURI(urlRetour.replace(/\//g,charSepUrlSlash)));
        };

        $scope.cancel = function () {
            $location.path("/ng/com_zeapps_contact/contacts");
        };




    }]);