app.run(["zeHttp", "$rootScope", function(zhttp, $rootScope){
    zhttp.contact.account_families.get_all().then(function(response){
        if(response.data && response.data != "false"){
            angular.forEach(response.data, function(account_family){
                account_family.sort = parseInt(account_family.sort);
            });
            $rootScope.account_families = response.data;
        }
    });

    zhttp.contact.topologies.get_all().then(function(response){
        if(response.data && response.data != "false"){
            angular.forEach(response.data, function(topology){
                topology.sort = parseInt(topology.sort);
            });
            $rootScope.topologies = response.data;
        }
    });
}]);