// declare the modal to the app service
listModuleModalFunction.push({
    module_name:'com_zeapps_contact',
    function_name:'search_contact',
    templateUrl:'/com_zeapps_contact/contacts/modal_contact',
    controller:'ZeAppsContactsModalContactCtrl',
    size:'lg',
    resolve:{
        titre: function () {
            return 'Recherche d\'un contact';
        }
    }
});


app.controller('ZeAppsContactsModalContactCtrl', function($scope, $uibModalInstance, $http, titre, option) {
    $scope.titre = titre ;


    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };



    var loadList = function () {
        var options = {};
        $http.post('/com_zeapps_contact/contacts/getAll', options).then(function (response) {
            if (response.status == 200) {
                $scope.contacts = response.data ;
            }
        });
    };
    loadList() ;


    $scope.loadContact = function (contact) {
        $uibModalInstance.close(contact);
    }

}) ;