app.config(["$provide",
	function ($provide) {
		$provide.decorator("zeHttp", function($delegate){
			var zeHttp = $delegate;

			zeHttp.contact = {
				company : {
					get : get_company,
					all : getAll_company,
					modal : modal_company
				},
				contact : {
					get : get_contact,
					all : getAll_contact
				},
				account_families : {
					get : get_accountFamilies,
					get_all : getAll_accountFamilies,
					save : save_accountFamilies,
					save_all : saveAll_accountFamilies,
					del : delete_accountFamilies
				},
				topologies : {
					get : get_topologies,
					get_all : getAll_topologies,
					save : save_topologies,
					save_all : saveAll_topologies,
					del : delete_topologies
				}
			};

			zeHttp.config = angular.extend(zeHttp.config || {}, {
			});

			return zeHttp;



			function get_company(id){
				return zeHttp.get("/com_zeapps_contact/companies/get/" + id);
			}
			function getAll_company(){
				return zeHttp.get("/com_zeapps_contact/companies/getAll");
			}
			function modal_company(limit, offset){
				return zeHttp.get("/com_zeapps_contact/companies/modal/" + limit + "/" + offset);
			}

			function get_contact(id){
				return zeHttp.get("/com_zeapps_contact/contacts/get/" + id);
			}
			function getAll_contact(id){
				id = id || "";
				return zeHttp.get("/com_zeapps_contact/contacts/getAll/" + id);
			}

			function get_accountFamilies(id){
				return zeHttp.get("/com_zeapps_contact/account_families/get/" + id);
			}
			function getAll_accountFamilies(){
				return zeHttp.get("/com_zeapps_contact/account_families/get_all/");
			}
			function save_accountFamilies(data){
				return zeHttp.post("/com_zeapps_contact/account_families/save/", data);
			}
			function saveAll_accountFamilies(data){
				return zeHttp.post("/com_zeapps_contact/account_families/save_all/", data);
			}
			function delete_accountFamilies(id){
				return zeHttp.get("/com_zeapps_contact/account_families/delete/" + id);
			}

			function get_topologies(id){
				return zeHttp.get("/com_zeapps_contact/topologies/get/" + id);
			}
			function getAll_topologies(){
				return zeHttp.get("/com_zeapps_contact/topologies/get_all/");
			}
			function save_topologies(data){
				return zeHttp.post("/com_zeapps_contact/topologies/save/", data);
			}
			function saveAll_topologies(data){
				return zeHttp.post("/com_zeapps_contact/topologies/save_all/", data);
			}
			function delete_topologies(id){
				return zeHttp.get("/com_zeapps_contact/topologies/delete/" + id);
			}
		});
	}]);