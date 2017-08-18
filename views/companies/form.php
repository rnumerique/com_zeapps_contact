<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Entreprises</div>
<div id="content">


    <form>
        <div class="well">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Type de compte</label>
                        <select ng-model="form.id_account_family" class="form-control">
                            <option ng-repeat="account_family in account_families" value="{{account_family.id}}">
                                {{ account_family.label }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Topologie</label>
                        <select ng-model="form.id_topology" class="form-control">
                            <option ng-repeat="topology in topologies" value="{{topology.id}}">
                                {{ topology.label }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Compte comptable</label>
                        <select ng-model="form.accounting_number" class="form-control">
                            <option>xxxxxxxxxxxx</option>
                            <option>xxxxxxxxxxxx</option>
                            <option>xxxxxxxxxxxx</option>
                            <option>xxxxxxxxxxxx</option>
                            <option>xxxxxxxxxxxx</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Gestionnaire du Compte</label>

                        <span   ze-modalsearch="loadAccountManager"
                                data-http="accountManagerHttp"
                                data-model="form.name_user_account_manager"
                                data-fields="accountManagerFields"
                                data-title="Choisir un utilisateur"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="well">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" ng-model="form.company_name" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Société Mère</label>

                        <span   ze-modalsearch="loadParentCompany"
                                data-http="parentCompanyHttp"
                                data-model="form.name_parent_company"
                                data-fields="parentCompanyFields"
                                data-title="Choisir une entreprise"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>SIRET</label>
                        <input type="text" ng-model="form.company_number" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Code NAF</label>
                        <span   ze-modalsearch="loadCodeNaf"
                                data-http="codeNafHttp"
                                data-model="form.code_naf_libelle"
                                data-fields="codeNafFields"
                                data-title="Choisir un code NAF"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Chiffre d’affaires</label>
                        <input type="text" ng-model="form.turnover" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="well">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="text" ng-model="form.phone" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Télécopie</label>
                        <input type="text" ng-model="form.fax" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>URL du site web</label>
                        <input type="text" ng-model="form.website_url" class="form-control">
                    </div>
                </div>
            </div>
        </div>



        <div class="well">
            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <label>Adresse de facturation</label>
                        <input type="text" ng-model="form.billing_address_1" class="form-control">
                        <input type="text" ng-model="form.billing_address_2" class="form-control">
                        <input type="text" ng-model="form.billing_address_3" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Code postal</label>
                        <input type="text" ng-model="form.billing_zipcode" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Ville</label>
                        <input type="text" ng-model="form.billing_city" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>État</label>
                        <input type="text" ng-model="form.billing_state" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Pays</label>

                        <span   ze-modalsearch="loadCountryBilling"
                                data-http="countriesHttp"
                                data-model="form.billing_country_name"
                                data-fields="countriesFields"
                                data-title="Choisir un pays"></span>
                    </div>
                </div>


                <div class="col-md-6">

                    <div class="form-group">
                        <label>Adresse de livraison</label>
                        <input type="text" ng-model="form.delivery_address_1" class="form-control">
                        <input type="text" ng-model="form.delivery_address_2" class="form-control">
                        <input type="text" ng-model="form.delivery_address_3" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Code postal</label>
                        <input type="text" ng-model="form.delivery_zipcode" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Ville</label>
                        <input type="text" ng-model="form.delivery_city" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>État</label>
                        <input type="text" ng-model="form.delivery_state" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Pays</label>

                        <span   ze-modalsearch="loadCountryDelivery"
                                data-http="countriesHttp"
                                data-model="form.delivery_country_name"
                                data-fields="countriesFields"
                                data-title="Choisir un pays"></span>
                    </div>
                </div>
            </div>
        </div>




        <div class="well">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Commentaire</label>
                        <textarea class="form-control" rows="3" ng-model="form.comment"></textarea>
                    </div>
                </div>
            </div>
        </div>


        <form-buttons></form-buttons>
    </form>


</div>