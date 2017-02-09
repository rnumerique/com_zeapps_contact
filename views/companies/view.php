<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Entreprises</div>
<div id="content">




    <form>
        <div class="well">
            <div class="row">
                <div class="col-md-3">
                    <div class="titleWell">{{form.company_name}}</div>
                </div>

                <div class="col-md-3">
                    <strong>Adresse de facturation :</strong><br>
                    <span ng-if="form.billing_address_1 != ''">{{form.billing_address_1}}<br></span>
                    <span ng-if="form.billing_address_2 != ''">{{form.billing_address_2}}<br></span>
                    <span ng-if="form.billing_address_3 != ''">{{form.billing_address_3}}<br></span>
                    <span ng-if="form.billing_zipcode != '' || form.billing_city != ''">{{form.billing_zipcode}} {{form.billing_city}}<br></span>
                    <span ng-if="form.billing_state != ''">{{form.billing_state}}<br></span>
                    <span ng-if="form.billing_country_name != ''">{{form.billing_country_name}}<br></span>
                </div>

                <div class="col-md-3">
                    <strong>Adresse de livraison :</strong><br>
                    <span ng-if="form.delivery_address_1 != ''">{{form.delivery_address_1}}<br></span>
                    <span ng-if="form.delivery_address_2 != ''">{{form.delivery_address_2}}<br></span>
                    <span ng-if="form.delivery_address_3 != ''">{{form.delivery_address_3}}<br></span>
                    <span ng-if="form.delivery_zipcode != '' || form.delivery_city != ''">{{form.delivery_zipcode}} {{form.delivery_city}}<br></span>
                    <span ng-if="form.delivery_state != ''">{{form.delivery_state}}<br></span>
                    <span ng-if="form.delivery_country_name != ''">{{form.delivery_country_name}}<br></span>
                </div>

                <div class="col-md-3">
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary btn-xs" ng-click="cancel()"><span class="glyphicon glyphicon-arrow-left"></span></button>
                        <button type="button" class="btn btn-success btn-xs" ng-click="edit()"><span class="glyphicon glyphicon-pencil"></span></button>


                        <div class="btn-group btn-group-xs" role="group" ng-if="nb_companies > 0">
                            <button type="button" class="btn btn-default" ng-class="company_first == 0 ? 'disabled' :''" ng-click="first_company()"><span class="glyphicon glyphicon-fast-backward"></span></button>
                            <button type="button" class="btn btn-default" ng-class="company_previous == 0 ? 'disabled' :''" ng-click="previous_company()"><span class="glyphicon glyphicon-chevron-left"></span></button>
                            <button type="button" class="btn btn-default disabled">{{companie_order}}/{{nb_companies}}</button>
                            <button type="button" class="btn btn-default" ng-class="company_next == 0 ? 'disabled' :''" ng-click="next_company()"><span class="glyphicon glyphicon-chevron-right"></span></button>
                            <button type="button" class="btn btn-default" ng-class="company_last == 0 ? 'disabled' :''" ng-click="last_company()"><span class="glyphicon glyphicon-fast-forward"></span></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>



        <ul df-tab-menu menu-control="{{navigationState}}"  theme="bootstrap" role="tablist" class="df-tab-menu nav nav-tabs">
            <li data-menu-item="summary"><a href="#" data-ng-click="navigationState = 'summary'">Résumé</a></li>
            <li data-menu-item="quote"><a href="#" data-ng-click="navigationState = 'quote'">Devis ({{ quotes.length }})</a></li>
            <li data-menu-item="order"><a href="#" data-ng-click="navigationState = 'order'">Commande (5)</a></li>
            <li data-menu-item="invoice"><a href="#" data-ng-click="navigationState = 'invoice'">Facutre (12)</a></li>
            <li data-menu-item="delivery"><a href="#" data-ng-click="navigationState = 'delivery'">Bon de livraison (3)</a></li>
            <li data-menu-item="purchase"><a href="#" data-ng-click="navigationState = 'purchase'">Achat</a></li>
            <li data-menu-item="purchase-receipt"><a href="#" data-ng-click="navigationState = 'purchase-receipt'">Bon de réception</a></li>
            <li data-menu-item="contract"><a href="#" data-ng-click="navigationState = 'contract'">Contrat</a></li>
            <li data-menu-item="projects"><a href="#" data-ng-click="navigationState = 'projects'">Projets (5)</a></li>
            <li data-menu-item="ticket"><a href="#" data-ng-click="navigationState = 'ticket'">Ticket</a></li>
            <li data-menu-item="activity"><a href="#" data-ng-click="navigationState = 'activity'">Activité</a></li>

            <li data-more-menu-item><a class="btn btn-primary"><span class="glyphicon glyphicon-menu-down"></span></a></li>
        </ul>



        <div class="row" ng-show="navigationState=='summary'">
            <div class="col-md-12">
                sommaire
            </div>
        </div>

        <div class="row" ng-show="navigationState=='quote'">
            <div class="col-md-12 text-right">
                <a class="btn btn-sm btn-primary" href="/ng/com_zeapps_crm/quote/new/{{ form.id }}">
                    <span class="glyphicon glyphicon-plus"></span>
                    Nouveau Devis
                </a>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-striped table-condensed table-responsive">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Contact</th>
                        <th>Entreprise</th>
                        <th>Total HT</th>
                        <th>Total TTC</th>
                        <th>Date de création</th>
                        <th>Date limite</th>
                        <th>Responsable</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="quote in quotes">
                        <td><a href="/ng/com_zeapps_crm/quote/{{quote.id}}">{{quote.libelle}}</a></td>
                        <td><a href="/ng/com_zeapps_crm/quote/{{quote.id}}">{{quote.contact.first_name[0] + '. ' + quote.contact.last_name}}</a></td>
                        <td><a href="/ng/com_zeapps_crm/quote/{{quote.id}}">{{quote.company.company_name}}</a></td>
                        <td><a href="/ng/com_zeapps_crm/quote/{{quote.id}}">{{totalHT(quote)}}</a></td>
                        <td><a href="/ng/com_zeapps_crm/quote/{{quote.id}}">{{totalTTC(quote)}}</a></td>
                        <td><a href="/ng/com_zeapps_crm/quote/{{quote.id}}">{{quote.date_creation | date:'dd/MM/yyyy'}}</a></td>
                        <td><a href="/ng/com_zeapps_crm/quote/{{quote.id}}">{{quote.date_limit | date:'dd/MM/yyyy'}}</a></td>
                        <td><a href="/ng/com_zeapps_crm/quote/{{quote.id}}">{{quote.user_name}}</a></td>
                        <td><button type="button" class="btn btn-danger btn-sm" ng-click="delete(quote)">Supprimer</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row" ng-show="navigationState=='order'">
            <div class="col-md-12">
                order
            </div>
        </div>

        <div class="row" ng-show="navigationState=='invoice'">
            <div class="col-md-12">
                invoice
            </div>
        </div>

        <div class="row" ng-show="navigationState=='delivery'">
            <div class="col-md-12">
                delivery
            </div>
        </div>

        <div class="row" ng-show="navigationState=='purchase'">
            <div class="col-md-12">
                purchase
            </div>
        </div>

        <div class="row" ng-show="navigationState=='purchase-receipt'">
            <div class="col-md-12">
                purchase-receipt
            </div>
        </div>

        <div class="row" ng-show="navigationState=='contract'">
            <div class="col-md-12">
                contract
            </div>
        </div>

        <div class="row" ng-show="navigationState=='projects'">
            <div class="col-md-12">
                projects
            </div>
        </div>

        <div class="row" ng-show="navigationState=='ticket'">
            <div class="col-md-12">
                ticket
            </div>
        </div>

        <div class="row" ng-show="navigationState=='activity'">
            <div class="col-md-12">
                Activité
            </div>
        </div>


    </form>


</div>