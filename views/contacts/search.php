<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Contacts</div>
<div id="content">


    <div class="row">
        <div class="col-md-12">
            <a href="/ng/com_zeapps_contact/contacts/new" class="btn btn-primary">Nouveau contact</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="contacts.length">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>Ville</th>
                    <th>Gestionnaire du compte</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="contact in contacts">
                    <td><a href="/ng/com_zeapps_contact/contacts/{{contact.id}}">{{contact.first_name}} {{contact.last_name}}</a></td>
                    <td><a href="/ng/com_zeapps_contact/contacts/{{contact.id}}">{{contact.phone}}</a></td>
                    <td><a href="/ng/com_zeapps_contact/contacts/{{contact.id}}">{{contact.city}}</a></td>
                    <td><a href="/ng/com_zeapps_contact/contacts/{{contact.id}}">{{contact.name_user_account_manager}}</a></td>
                    <td><button type="button" class="btn btn-danger btn-sm" ng-click="delete(contact.id)">Supprimer</button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


</div>