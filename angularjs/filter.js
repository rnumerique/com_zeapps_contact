app.filter('com_zeapps_contactContactFilter', function($filter){
    return function(list, filters){
        if(filters){
            return $filter("filter")(list, function(listItem){
                if(filters.first_name != undefined && filters.first_name != '') {
                    var regex = new RegExp(filters.first_name, 'i');
                    if(listItem.first_name.search(regex) == -1)
                        return false;
                }
                if(filters.last_name != undefined && filters.last_name != '') {
                    var regex = new RegExp(filters.last_name, 'i');
                    if(listItem.last_name.search(regex) == -1)
                        return false;
                }
                if(filters.zipcode != undefined && filters.zipcode != '') {
                    var regex = new RegExp(filters.zipcode, 'i');
                    if(listItem.zipcode.search(regex) == -1)
                        return false;
                }
                if(filters.city != undefined && filters.city != '') {
                    var regex = new RegExp(filters.city, 'i');
                    if(listItem.city.search(regex) == -1)
                        return false;
                }

                if(filters.id_type_account != undefined && filters.id_type_account != 'none') {
                    if(listItem.id_type_account != filters.id_type_account)
                        return false;
                }
                if(filters.country_id != undefined && filters.country_id != '') {
                    if(listItem.country_id != filters.country_id)
                        return false;
                }
                return true;
            });
        }
        return list;
    };
}).filter('com_zeapps_contactEntrepriseFilter', function($filter){
    return function(list, filters){
        if(filters){
            return $filter("filter")(list, function(listItem){
                if(filters.name_company != undefined && filters.name_company != '') {
                    var regex = new RegExp(filters.name_company, 'i');
                    if(listItem.name_company.search(regex) == -1)
                        return false;
                }
                if(filters.code_naf != undefined && filters.code_naf != '') {
                    if(listItem.code_naf != filters.code_naf)
                        return false;
                }
                if(filters.zipcode != undefined && filters.zipcode != '') {
                    var regex = new RegExp(filters.zipcode, 'i');
                    if(listItem.zipcode.search(regex) == -1)
                        return false;
                }
                if(filters.city != undefined && filters.city != '') {
                    var regex = new RegExp(filters.city, 'i');
                    if(listItem.city.search(regex) == -1)
                        return false;
                }

                if(filters.id_type_account != undefined && filters.id_type_account != 'none') {
                    if(listItem.id_type_account != filters.id_type_account)
                        return false;
                }
                if(filters.country_id != undefined && filters.country_id != '') {
                    if(listItem.country_id != filters.country_id)
                        return false;
                }
                return true;
            });
        }
        return list;
    };
});