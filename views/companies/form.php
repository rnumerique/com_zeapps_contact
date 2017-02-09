<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Entreprises</div>
<div id="content">


    <form>
        <div class="well">
            <div class="row">
                <div class="col-md-6">


                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" ng-model="form.company_name" class="form-control">
                    </div>


                    <div class="form-group">
                        <label>Société Mère</label>
                        <div class="input-group">
                            <input type="text" ng-model="form.name_parent_company" class="form-control" disabled>
                            <input type="hidden" ng-model="form.id_parent_company">

                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" ng-click="removeParentCompany()"
                                        ng-show="form.id_parent_company != 0 && form.id_parent_company != undefined">x
                                </button>
                                <button class="btn btn-default" type="button" ng-click="loadParentCompany()">...</button>
                            </span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Type de compte</label>
                        <select ng-model="form.id_type_account" class="form-control">
                            <option>xxxxxxxxxxxx</option>
                            <option>xxxxxxxxxxxx</option>
                            <option>xxxxxxxxxxxx</option>
                            <option>xxxxxxxxxxxx</option>
                            <option>xxxxxxxxxxxx</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label>Secteur d’activité</label>
                        <select ng-model="form.id_activity_area" class="form-control">
                            <option>xxxxxxxxxxxx</option>
                            <option>xxxxxxxxxxxx</option>
                            <option>xxxxxxxxxxxx</option>
                            <option>xxxxxxxxxxxx</option>
                            <option>xxxxxxxxxxxx</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label>Chiffre d’affaires</label>
                        <input type="text" ng-model="form.turnover" class="form-control">
                    </div>


                    <div class="form-group">
                        <label>SIRET</label>
                        <input type="text" ng-model="form.company_number" class="form-control">
                    </div>
                </div>


                <div class="col-md-6">

                    <div class="form-group">
                        <label>Gestionnaire du Compte</label>
                        <div class="input-group">
                            <input type="text" ng-model="form.name_user_account_manager" class="form-control" disabled>
                            <input type="hidden" ng-model="form.id_user_account_manager">

                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" ng-click="removeAccountManager()"
                                        ng-show="form.id_user_account_manager != 0 && form.id_user_account_manager != undefined">x
                                </button>
                                <button class="btn btn-default" type="button" ng-click="loadAccountManager()">...</button>
                            </span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="text" ng-model="form.phone" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Télécopie</label>
                        <input type="text" ng-model="form.fax" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>URL du site web</label>
                        <input type="text" ng-model="form.website_url" class="form-control">
                    </div>


                    <div class="form-group">
                        <label>Code NAF</label>
                        <div class="input-group">
                            <input type="text" ng-model="form.code_naf_libelle" class="form-control" disabled>
                            <input type="hidden" ng-model="form.code_naf">

                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" ng-click="removeCodeNaf()"
                                        ng-show="form.code_naf != '' && form.code_naf != undefined">x
                                </button>
                            <button class="btn btn-default" type="button" ng-click="loadCodeNaf()">...</button>
                            </span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Compte comptable</label>
                        <input type="text" ng-model="form.accounting_number" class="form-control">
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
                        <div class="input-group">
                            <input type="text" ng-model="form.billing_country_name" class="form-control" disabled>
                            <input type="hidden" ng-model="form.billing_country_id">

                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button">...</button>
                            </span>
                        </div>
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
                        <div class="input-group">
                            <input type="text" ng-model="form.delivery_country_name" class="form-control" disabled>
                            <input type="hidden" ng-model="form.delivery_country_id">

                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button">...</button>
                            </span>
                        </div>
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