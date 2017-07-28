<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">
    Entreprises
</div>
<div id="content">
    <ze-filters data-model="filter.model" data-options="filter.options"></ze-filters>

    <div class="row">
        <div class="col-md-12">
            <a href="/ng/com_zeapps_contact/companies/new" class="btn btn-success btn-xs pull-right">
                <i class="fa fa-fw fa-plus"></i> entreprise
            </a>
        </div>
    </div>

    <div class="text-center" ng-show="companies.length > pageSize">
        <ul uib-pagination total-items="(companies | com_zeapps_contactEntrepriseFilter:filters).length" ng-model="page" items-per-page="pageSize" class="pagination-sm" boundary-links="true"
            previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-condensed table-responsive" ng-show="companies.length">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>Ville</th>
                    <th>Gestionnaire du compte</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="company in companies | com_zeapps_contactEntrepriseFilter:filter.model | startFrom:(page - 1)*pageSize | limitTo:pageSize">
                    <td><a href="/ng/com_zeapps_contact/companies/{{company.id}}">{{company.company_name}}</a></td>
                    <td><a href="/ng/com_zeapps_contact/companies/{{company.id}}">{{company.phone}}</a></td>
                    <td><a href="/ng/com_zeapps_contact/companies/{{company.id}}">{{company.billing_city}}</a></td>
                    <td><a href="/ng/com_zeapps_contact/companies/{{company.id}}">{{company.name_user_account_manager}}</a></td>
                    <td class="text-right">
                        <button type="button" class="btn btn-danger btn-xs" ng-click="delete(company.id)">
                            <i class="fa fa-fw fa-trash"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center" ng-show="companies.length > pageSize">
        <ul uib-pagination total-items="(companies | com_zeapps_contactEntrepriseFilter:filters).length" ng-model="page" items-per-page="pageSize" class="pagination-sm" boundary-links="true"
            previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></ul>
    </div>

</div>