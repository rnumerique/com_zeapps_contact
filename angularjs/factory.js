app.config(['$provide',
    function ($provide) {
        $provide.decorator('zeHttp', function($delegate){
            var zeHttp = $delegate;

            zeHttp.contact = {
                company : {
                    get : get_company
                },
                contact : {
                    get : get_contact,
                    all : getAll_contact
                }
            };

            zeHttp.config = angular.extend(zeHttp.config || {}, {
            });

            return zeHttp;



            function get_company(id){
                return zeHttp.get('/com_zeapps_contact/companies/get/' + id);
            }

            function get_contact(id){
                return zeHttp.get('/com_zeapps_contact/contacts/get/' + id);
            }
            function getAll_contact(id){
                id = id || '';
                return zeHttp.get('/com_zeapps_contact/contacts/getAll/' + id);
            }
        });
    }]);