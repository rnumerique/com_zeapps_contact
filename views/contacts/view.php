<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Entreprises</div>
<div id="content">




    <form>
        <div class="well">
            <div class="row">
                <div class="col-md-3">
                    <div class="titleWell">{{form.title_name + ' ' + form.first_name + ' ' + form.last_name}}</div>
                </div>

                <div class="col-md-3">
                    <strong>Contact :</strong><br>
                    <span ng-if="form.phone"><i class="fa fa-fw fa-phone"></i> {{form.phone}}<br></span>
                    <span ng-if="form.mobile"><i class="fa fa-fw fa-mobile"></i> {{form.mobile}}<br></span>
                    <span ng-if="form.other_phone"><i class="fa fa-fw fa-phone"></i> {{form.other_phone}}<br></span>
                    <span ng-if="form.email"><i class="fa fa-fw fa-envelope-o"></i> {{form.email}}<br></span>
                    <span ng-if="form.fax"><i class="fa fa-fw fa-fax"></i> {{form.fax}}<br></span>
                </div>

                <div class="col-md-3">
                    <strong>Adresse :</strong><br>
                    <span ng-if="form.address_1 != ''">{{form.address_1}}<br></span>
                    <span ng-if="form.address_2 != ''">{{form.address_2}}<br></span>
                    <span ng-if="form.address_3 != ''">{{form.address_3}}<br></span>
                    <span ng-if="form.zipcode != '' || form.city != ''">{{form.zipcode}} {{form.city}}<br></span>
                    <span ng-if="form.state != ''">{{form.state}}<br></span>
                    <span ng-if="form.country_name != ''">{{form.country_name}}<br></span>
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



        <div class="row" ng-show="isTabActive('summary')">
            <div class="col-md-12">
                sommaire
            </div>
        </div>

        <div ng-show="isTabActive(hook.label)" ng-repeat="hook in hooks">
            <div ng-include="hook.template">
            </div>
        </div>

    </form>


</div>