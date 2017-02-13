<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Contacts</div>
<div id="content">


    <div class="row">
        <div class="col-md-12 text-right">
            <a href="/ng/com_zeapps_contact/contacts/new" class="btn btn-success btn-xs">
                <i class="fa fa-fw fa-plus"></i> contact
            </a>
        </div>
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
                        <button type="button" class="btn btn-danger btn-xs" ng-click="delete(contact.id)">
                            <i class="fa fa-fw fa-trash"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


</div>