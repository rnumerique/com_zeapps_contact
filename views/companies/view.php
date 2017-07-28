<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="content">
    <form>
        <div class="well">
            <div class="row">
                <div class="col-md-3">
                    <div class="titleWell">
                        {{form.company_name}}
                    </div>
                    <div>
                        <small>{{form.name_parent_company}}</small>
                    </div>
                </div>

                <div class="col-md-3">
                    <strong>Topologie : </strong>{{form.name_topology}} <br>
                    <strong>Famille : </strong>{{form.name_account_family}}
                </div>

                <div class="col-md-3">
                    <strong>Manager : </strong>{{form.name_user_account_manager}}
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
        </ul>

        <div ng-show="isTabActive(hook.label)" ng-repeat="hook in hooks">
            <div ng-include="hook.template">
            </div>
        </div>

        <div ng-show="isTabActive('summary')">
            <div class="row">
                <div class="col-md-4">
                    <strong>Activité : </strong>{{form.name_activity_area}}
                </div>
                <div class="col-md-4">
                    <strong>SIRET : </strong>{{form.company_number}}
                </div>
                <div class="col-md-4">
                    <strong>Code naf : </strong>{{form.code_naf_libelle}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <strong>Chiffre d'affaire : </strong>{{form.turnover | currency:'€'}}
                </div>
                <div class="col-md-4">
                    <strong>Compte comptable : </strong>{{form.accounting_number}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <strong>Information de contact : </strong>
                    </div>
                    <div class="well">
                        <div class="row">
                            <div class="col-md-4">
                                <i class="fa fa-fw fa-phone"></i> {{form.phone}}
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-fw fa-fax"></i> {{form.fax}}
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-fw fa-globe"></i> {{form.website_url}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <strong>Adresse de facturation :</strong>
                    </div>
                    <div class="well">
                        <span ng-if="form.billing_address_1 != ''">{{form.billing_address_1}}<br></span>
                        <span ng-if="form.billing_address_2 != ''">{{form.billing_address_2}}<br></span>
                        <span ng-if="form.billing_address_3 != ''">{{form.billing_address_3}}<br></span>
                        <span ng-if="form.billing_zipcode != '' || form.billing_city != ''">{{form.billing_zipcode}} {{form.billing_city}}<br></span>
                        <span ng-if="form.billing_state != ''">{{form.billing_state}}<br></span>
                        <span ng-if="form.billing_country_name != ''">{{form.billing_country_name}}<br></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div>
                        <strong>Adresse de livraison :</strong>
                    </div>
                    <div class="well">
                        <span ng-if="form.delivery_address_1 != ''">{{form.delivery_address_1}}<br></span>
                        <span ng-if="form.delivery_address_2 != ''">{{form.delivery_address_2}}<br></span>
                        <span ng-if="form.delivery_address_3 != ''">{{form.delivery_address_3}}<br></span>
                        <span ng-if="form.delivery_zipcode != '' || form.delivery_city != ''">{{form.delivery_zipcode}} {{form.delivery_city}}<br></span>
                        <span ng-if="form.delivery_state != ''">{{form.delivery_state}}<br></span>
                        <span ng-if="form.delivery_country_name != ''">{{form.delivery_country_name}}<br></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <strong>Commentaire :</strong>
                    </div>
                    <div class="well">
                        {{form.comment}}
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>