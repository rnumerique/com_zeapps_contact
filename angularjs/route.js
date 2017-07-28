app.config(["$routeProvider",
	function ($routeProvider) {
		$routeProvider
		// COMPANIES
			.when("/ng/com_zeapps_contact/companies", {
				templateUrl: "/com_zeapps_contact/companies/search",
				controller: "ComZeappsContactCompaniesListCtrl"
			})
			.when("/ng/com_zeapps_contact/companies/new", {
				templateUrl: "/com_zeapps_contact/companies/form",
				controller: "ComZeappsContactCompaniesFormListCtrl"
			})
			.when("/ng/com_zeapps_contact/companies/new/retour/:url_retour", {
				templateUrl: "/com_zeapps_contact/companies/form",
				controller: "ComZeappsContactCompaniesFormListCtrl"
			})
			.when("/ng/com_zeapps_contact/companies/:id", {
				templateUrl: "/com_zeapps_contact/companies/view",
				controller: "ComZeappsContactCompaniesViewCtrl"
			})
			.when("/ng/com_zeapps_contact/companies/:id/edit", {
				templateUrl: "/com_zeapps_contact/companies/form",
				controller: "ComZeappsContactCompaniesFormListCtrl"
			})
			.when("/ng/com_zeapps_contact/companies/:id/edit/retour/:url_retour", {
				templateUrl: "/com_zeapps_contact/companies/form",
				controller: "ComZeappsContactCompaniesFormListCtrl"
			})


		// CONTACT
			.when("/ng/com_zeapps_contact/contacts", {
				templateUrl: "/com_zeapps_contact/contacts/search",
				controller: "ComZeappsContactContactsListCtrl"
			})
			.when("/ng/com_zeapps_contact/contacts/new", {
				templateUrl: "/com_zeapps_contact/contacts/form",
				controller: "ComZeappsContactContactsFormListCtrl"
			})
			.when("/ng/com_zeapps_contact/contacts/:id", {
				templateUrl: "/com_zeapps_contact/contacts/view",
				controller: "ComZeappsContactContactsViewCtrl"
			})
			.when("/ng/com_zeapps_contact/contacts/:id/edit", {
				templateUrl: "/com_zeapps_contact/contacts/form",
				controller: "ComZeappsContactContactsFormListCtrl"
			})
			.when("/ng/com_zeapps_contact/contacts/:id/edit/retour/:url_retour", {
				templateUrl: "/com_zeapps_contact/contacts/form",
				controller: "ComZeappsContactContactsFormListCtrl"
			})


		// CONFIG
			.when("/ng/com_zeapps/account_families", {
				templateUrl: "/com_zeapps_contact/account_types/config",
				controller: "ComZeappsContactAccountFamiliesConfigCtrl"
			})
			.when("/ng/com_zeapps/topologies", {
				templateUrl: "/com_zeapps_contact/topologies/config",
				controller: "ComZeappsContactTopologiesConfigCtrl"
			})
		;
	}]);

