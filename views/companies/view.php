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
                        <button type="button" class="btn btn-primary btn-xs" ng-click="cancel()"><span class="fa fa-fw fa-arrow-left"></span></button>
                        <button type="button" class="btn btn-info btn-xs" ng-click="edit()"><span class="fa fa-fw fa-pencil"></span></button>


                        <div class="btn-group btn-group-xs" role="group" ng-if="nb_companies > 0">
                            <button type="button" class="btn btn-default" ng-class="company_first == 0 ? 'disabled' :''" ng-click="first_company()"><span class="fa fa-fw fa-fast-backward"></span></button>
                            <button type="button" class="btn btn-default" ng-class="company_previous == 0 ? 'disabled' :''" ng-click="previous_company()"><span class="fa fa-fw fa-chevron-left"></span></button>
                            <button type="button" class="btn btn-default disabled">{{companie_order}}/{{nb_companies}}</button>
                            <button type="button" class="btn btn-default" ng-class="company_next == 0 ? 'disabled' :''" ng-click="next_company()"><span class="fa fa-fw fa-chevron-right"></span></button>
                            <button type="button" class="btn btn-default" ng-class="company_last == 0 ? 'disabled' :''" ng-click="last_company()"><span class="fa fa-fw fa-fast-forward"></span></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>



        <ul role="tablist" class="nav nav-tabs">
            <li role="presentation" ng-class="isTabActive('summary') ? 'active' : ''"><a href="#" ng-click="setTab('summary')">Résumé</a></li>

            <li role="presentation" ng-class="isTabActive(hook.label) ? 'active' : ''" ng-repeat="hook in hooks">
                <a href="#" ng-click="setTab(hook.label)">{{ hook.label }}</a>
            </li>

            <li role="presentation" ng-class="isTabActive('delivery') ? 'active' : ''"><a href="#" ng-click="setTab('delivery')">Bon de livraison</a></li>
            <li role="presentation" ng-class="isTabActive('purchase') ? 'active' : ''"><a href="#" ng-click="setTab('purchase')">Achat</a></li>
            <li role="presentation" ng-class="isTabActive('receipt') ? 'active' : ''"><a href="#" ng-click="setTab('receipt')">Bon de réception</a></li>
            <li role="presentation" ng-class="isTabActive('contract') ? 'active' : ''"><a href="#" ng-click="setTab('contract')">Contrat</a></li>
            <li role="presentation" ng-class="isTabActive('projects') ? 'active' : ''"><a href="#" ng-click="setTab('projects')">Projets</a></li>
            <li role="presentation" ng-class="isTabActive('ticket') ? 'active' : ''"><a href="#" ng-click="setTab('ticket')">Ticket</a></li>
            <li role="presentation" ng-class="isTabActive('activity') ? 'active' : ''"><a href="#" ng-click="setTab('activity')">Activité</a></li>
        </ul>



        <div class="row" ng-show="isTabActive('summary')">
            <div class="col-md-12">
                sommaire
            </div>
        </div>

        <div ng-show="isTabActive(hook.label)" ng-repeat="hook in hooks">
            <div ng-include="hook.template">
            </div>
        </div>

        <div class="row" ng-show="isTabActive('delivery')">
            <div class="col-md-12">
                delivery
            </div>
        </div>

        <div class="row" ng-show="isTabActive('purchase')">
            <div class="col-md-12">
                purchase
            </div>
        </div>

        <div class="row" ng-show="isTabActive('receipt')">
            <div class="col-md-12">
                purchase-receipt
            </div>
        </div>

        <div class="row" ng-show="isTabActive('contract')">
            <div class="col-md-12">
                contract
            </div>
        </div>

        <div class="row" ng-show="isTabActive('projects')">
            <div class="col-md-12">
                projects
            </div>
        </div>

        <div class="row" ng-show="isTabActive('ticket')">
            <div class="col-md-12">
                ticket
            </div>
        </div>

        <div class="row" ng-show="isTabActive('activity')">
            <div class="col-md-12">
                Activité
            </div>
        </div>


    </form>


</div>