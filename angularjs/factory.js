app.config(['$provide',
    function ($provide) {
        $provide.decorator('zeHttp', function($delegate){
            var zeHttp = $delegate;

            var get_company = function(id){
                return zeHttp.get('/com_zeapps_contact/companies/get/' + id);
            };

            zeHttp.contact = {
                company : {
                    get : get_company
                }
            };

            zeHttp.config = angular.extend(zeHttp.config || {}, {
            });

            return zeHttp;
        });
    }]);