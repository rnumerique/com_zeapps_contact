app.filter("com_zeapps_contactContactFilter", function($filter){
	return function(list, filters){
		if(filters){
			return $filter("filter")(list, function(listItem){
				if(filters.name != undefined && filters.name != "") {
					var regex = new RegExp(filters.name, "i");
					if((listItem.first_name +' '+ listItem.last_name).search(regex) == -1)
						return false;
				}
				if(filters.zipcode != undefined && filters.zipcode != "") {
					var regex = new RegExp(filters.zipcode, "i");
					if(listItem.zipcode.search(regex) == -1)
						return false;
				}
				if(filters.city != undefined && filters.city != "") {
					var regex = new RegExp(filters.city, "i");
					if(listItem.city.search(regex) == -1)
						return false;
				}

				if(filters.id_account_family != undefined && filters.id_account_family != "") {
					if(listItem.id_account_family != filters.id_account_family)
						return false;
				}
				if(filters.id_topology != undefined && filters.id_topology != "") {
					if(listItem.id_topology != filters.id_topology)
						return false;
				}
				if(filters.country_id != undefined && filters.country_id != "") {
					if(listItem.country_id != filters.country_id)
						return false;
				}
				return true;
			});
		}
		return list;
	};
}).filter("com_zeapps_contactEntrepriseFilter", function($filter){
	return function(list, filters){
		if(filters){
			return $filter("filter")(list, function(listItem){
				if(filters.name != undefined && filters.name != "") {
					var regex = new RegExp(filters.name, "i");
					if(listItem.company_name.search(regex) == -1)
						return false;
				}
				if(filters.code_naf != undefined && filters.code_naf != "") {
					if(listItem.code_naf != filters.code_naf)
						return false;
				}
				if(filters.zipcode != undefined && filters.zipcode != "") {
					var regex = new RegExp(filters.zipcode, "i");
					if(listItem.billing_zipcode.search(regex) == -1)
						return false;
				}
				if(filters.city != undefined && filters.city != "") {
					var regex = new RegExp(filters.city, "i");
					if(listItem.billing_city.search(regex) == -1)
						return false;
				}

				if(filters.id_account_family != undefined && filters.id_account_family != "none") {
					if(listItem.id_account_family != filters.id_account_family)
						return false;
				}
				if(filters.id_topology != undefined && filters.id_topology != "none") {
					if(listItem.id_topology != filters.id_topology)
						return false;
				}
				if(filters.country_id != undefined && filters.country_id != "") {
					if(listItem.billing_country_id != filters.country_id)
						return false;
				}
				return true;
			});
		}
		return list;
	};
});