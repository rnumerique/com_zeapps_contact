<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="content">
    <form>
        <div class="well">
            <div class="row">
                <div class="col-md-3">
                    <div class="titleWell">
                        {{form.title_name + ' ' + form.first_name + ' ' + form.last_name}}
                    </div>
                    <div>
                        <small>{{form.name_company}}</small>
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
                    <strong>Date de naissance : </strong>{{form.date_of_birth | date:'dd/MM/yyyy'}}
                </div>
                <div class="col-md-4">
                    <strong>Service : </strong>{{form.name_activity_area}}
                </div>
                <div class="col-md-4">
                    <strong>Fonction : </strong>{{form.company_number}}
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
                                <i class="fa fa-fw fa-mobile"></i> {{form.mobile}}
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-fw fa-phone"></i> {{form.phone}}
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-fw fa-phone"></i> {{form.other_phone}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <i class="fa fa-fw fa-fax"></i> {{form.fax}}
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-fw fa-skype"></i> {{form.skype_id}}
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-fw fa-twitter"></i> {{form.twitter}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <i class="fa fa-fw fa-globe"></i> {{form.website_url}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <strong>Assistant(e) : </strong>
                    </div>
                    <div class="well">
                        <div class="row">
                            <div class="col-md-6">
                                <i class="fa fa-fw fa-user"></i> {{form.assistant}}
                            </div>
                            <div class="col-md-6">
                                <i class="fa fa-fw fa-phone"></i> {{form.assistant_phone}}
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
                        <span ng-if="form.address_1 != ''">{{form.address_1}}<br></span>
                        <span ng-if="form.address_2 != ''">{{form.address_2}}<br></span>
                        <span ng-if="form.address_3 != ''">{{form.address_3}}<br></span>
                        <span ng-if="form.zipcode != '' || form.city != ''">{{form.zipcode}} {{form.city}}<br></span>
                        <span ng-if="form.state != ''">{{form.state}}<br></span>
                        <span ng-if="form.country_name != ''">{{form.country_name}}<br></span>
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