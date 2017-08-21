<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div ng-controller="ComZeappsContactContactsListPartialCtrl">
    <div class="row">
        <div class="col-md-12">
            <ze-filters class="pull-right" data-model="filter_model" data-filters="filters" data-update="loadList"></ze-filters>

            <ze-btn fa="plus" color="success" hint="Contact" always-on="true"
                    ze-modalform="add"
                    data-template="templateForm"
                    data-title="Ajouter un nouveau contact"></ze-btn>
        </div>
    </div>

    <div class="text-center" ng-show="total > pageSize">
        <ul uib-pagination total-items="total" ng-model="page" items-per-page="pageSize" ng-change="loadList()"
            class="pagination-sm" boundary-links="true" max-size="15"
            previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-condensed table-responsive" ng-show="contacts.length">
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
                <tr ng-repeat="contact in contacts">
                    <td><a href="/ng/com_zeapps_contact/contacts/{{contact.id}}">{{contact.first_name}} {{contact.last_name}}</a></td>
                    <td><a href="/ng/com_zeapps_contact/contacts/{{contact.id}}">{{contact.phone}}</a></td>
                    <td><a href="/ng/com_zeapps_contact/contacts/{{contact.id}}">{{contact.city}}</a></td>
                    <td><a href="/ng/com_zeapps_contact/contacts/{{contact.id}}">{{contact.name_user_account_manager}}</a></td>
                    <td class="text-right">
                        <ze-btn fa="pencil" color="info" hint="Editer" direction="left"
                                ze-modalform="edit"
                                data-edit="contact"
                                data-template="templateForm"
                                data-title="Modifier le contact"></ze-btn>
                        <ze-btn fa="trash" color="danger" hint="Supprimer" direction="left" ng-click="delete(contact)" ze-confirmation></ze-btn>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center" ng-show="total > pageSize">
        <ul uib-pagination total-items="total" ng-model="page" items-per-page="pageSize" ng-change="loadList()"
            class="pagination-sm" boundary-links="true" max-size="15"
            previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></ul>
    </div>


</div>