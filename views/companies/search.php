<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb" class="clearfix">
    <div class="pull-right form-inline">
        <input type="text" class="form-control input-sm" ng-model="filters.name" placeholder="Nom">
        <select ng-model="filters.id_account_family" class="form-control input-sm">
            <option value="none">Famille</option>
            <option ng-repeat="account_family in account_families" value="{{account_family.id}}">
                {{ account_family.label }}
            </option>
        </select>
        <select ng-model="filters.id_topology" class="form-control input-sm">
            <option value="none">Topologie</option>
            <option ng-repeat="topology in topologies" value="{{topology.id}}">
                {{ topology.label }}
            </option>
        </select>

        <span ng-click="shownFilter = !shownFilter">
            <i class="fa fa-filter"></i> Filtres <i class="fa" ng-class="shownFilter ? 'fa-caret-up' : 'fa-caret-down'"></i>
        </span>
    </div>
    <h6>Entreprises</h6>
</div>
<div id="content">

    <div class="well" ng-if="shownFilter">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Code NAF</label>
                    <div class="input-group">
                        <input type="text" ng-model="filters.code_naf_libelle" class="form-control" disabled>
                        <input type="hidden" ng-model="filters.code_naf">

                        <span class="input-group-btn">
                                <button class="btn btn-default" type="button" ng-click="removeCodeNaf()"
                                        ng-show="filters.code_naf != '' && filters.code_naf != undefined">x
                                </button>
                            <button class="btn btn-default" type="button" ng-click="loadCodeNaf()">...</button>
                            </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Code Postal :</label>
                    <input type="text" class="form-control" ng-model="filters.zipcode">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Ville :</label>
                    <input type="text" class="form-control" ng-model="filters.city">
                </div>
            </div>
            <div class="col-md-4">
                <label>Pays</label>
                <div class="input-group">
                    <input type="text" ng-model="filters.country_lang_name" class="form-control" disabled>
                    <span class="input-group-btn">
                                <button class="btn btn-default" type="button" ng-click="removeCountryLang()"
                                        ng-show="filters.country_id != 0 && filters.country_id != undefined">x
                                </button>
                            <button class="btn btn-default" type="button" ng-click="loadCountryLang()">...</button>
                            </span>
                </div>
            </div>
        </div>
    </div>

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
                <tr ng-repeat="company in companies | com_zeapps_contactEntrepriseFilter:filters | startFrom:(page - 1)*pageSize | limitTo:pageSize">
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