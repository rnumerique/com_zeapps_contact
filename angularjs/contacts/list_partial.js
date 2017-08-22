app.controller("ComZeappsContactContactsListPartialCtrl", ["$scope", "$route", "$routeParams", "$location", "$rootScope", "zeHttp", "$uibModal", "zeapps_modal",
	function ($scope, $route, $routeParams, $location, $rootScope, zhttp, $uibModal, zeapps_modal) {

        $scope.filters = {
            main: [
                {
                    format: 'input',
                    field: 'first_name LIKE',
                    type: 'text',
                    label: 'Prénom'
                },
                {
                    format: 'input',
                    field: 'last_name LIKE',
                    type: 'text',
                    label: 'Nom'
                },
                {
                    format: 'select',
                    field: 'id_account_family',
                    type: 'text',
                    label: 'Famille',
                    options: []
                },
                {
                    format: 'select',
                    field: 'id_topology',
                    type: 'text',
                    label: 'Topologie',
                    options: []
                }
            ],
            secondaries: [
                {
                    format: 'input',
                    field: 'billing_city LIKE',
                    type: 'text',
                    label: 'Ville',
                    size: 6
                },
                {
                    format: 'input',
                    field: 'billing_zipcode LIKE',
                    type: 'text',
                    label: 'Code Postal',
                    size: 6
                }
            ]
        };
        $scope.filter_model = {};
		$scope.page = 1;
		$scope.pageSize = 15;
        $scope.total = 0;
        $scope.templateForm = '/com_zeapps_contact/contacts/form_modal';

        $scope.loadList = loadList;
        $scope.add = add;
        $scope.edit = edit;
		$scope.delete = del;

		loadList(true) ;

		function loadList(context) {
            context = context || "";
            var offset = ($scope.page - 1) * $scope.pageSize;
            var formatted_filters = angular.toJson($scope.filter_model);
            var id_company = $routeParams.id || '';

			zhttp.contact.contact.all(id_company, $scope.pageSize, offset, context, formatted_filters).then(function (response) {
				if (response.status == 200) {
                    if(context) {
                        $scope.filters.main[2].options = response.data.account_families;
                        $scope.filters.main[3].options = response.data.topologies;
                    }

                    $scope.contacts = response.data.contacts;
                    angular.forEach($scope.contacts, function(contact){
                        contact.date_of_birth = new Date(contact.date_of_birth);
                    });

                    $scope.total = response.data.total;
				}
			});
		}

        function add(contact) {
            var formatted_data = angular.toJson(contact);
            zhttp.contact.contact.save(formatted_data).then(function (response) {
                if (response.data && response.data != "false") {
                    loadList();
                }
            });
        }

        function edit(contact) {
            var formatted_data = angular.toJson(contact);
            zhttp.contact.contact.save(formatted_data);
        }

		function del(contact) {
            zhttp.contact.contact.del(contact.id).then(function (response) {
                if (response.status == 200) {
                    loadList();
                }
            });
		}


	}]);