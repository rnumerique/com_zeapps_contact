<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">
    Contacts
</div>
<div id="content">
    <ze-filters data-model="filter.model" data-options="filter.options"></ze-filters>
    <div class="row">
        <div class="col-md-12">
            <a href="/ng/com_zeapps_contact/contacts/new" class="btn btn-success btn-xs pull-right">
                <i class="fa fa-fw fa-plus"></i> contact
            </a>
        </div>
    </div>

    <div class="text-center" ng-show="contacts.length > pageSize">
        <ul uib-pagination total-items="(contacts | com_zeapps_contactContactFilter:filter.model).length" ng-model="page" items-per-page="pageSize" class="pagination-sm" boundary-links="true"
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
                <tr ng-repeat="contact in contacts | com_zeapps_contactContactFilter:filter.model | startFrom:(page - 1)*pageSize | limitTo:pageSize">
                    <td><a href="/ng/com_zeapps_contact/contacts/{{contact.id}}">{{contact.first_name}} {{contact.last_name}}</a></td>
                    <td><a href="/ng/com_zeapps_contact/contacts/{{contact.id}}">{{contact.phone}}</a></td>
                    <td><a href="/ng/com_zeapps_contact/contacts/{{contact.id}}">{{contact.city}}</a></td>
                    <td><a href="/ng/com_zeapps_contact/contacts/{{contact.id}}">{{contact.name_user_account_manager}}</a></td>
                    <td class="text-right">
                        <button type="button" class="btn btn-danger btn-xs" ng-click="delete(contact.id)">
                            <i class="fa fa-fw fa-trash"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center" ng-show="contacts.length > pageSize">
        <ul uib-pagination total-items="(contacts | com_zeapps_contactContactFilter:filters).length" ng-model="page" items-per-page="pageSize" class="pagination-sm" boundary-links="true"
            previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></ul>
    </div>


</div>