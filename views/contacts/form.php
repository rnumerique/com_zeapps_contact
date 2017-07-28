<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Contacts</div>
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
                </div>
            </div>
        </div>

        <div class="well">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Salutation</label>
                        <select ng-model="form.title_name" class="form-control">
                            <option value="M.">M.</option>
                            <option value="Mme">Mme</option>
                            <option value="Mlle">Mlle</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" ng-model="form.last_name" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" ng-model="form.first_name" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Date de naissance</label>
                        <input type="date" ng-model="form.date_of_birth" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Société</label>
                        <div class="input-group">
                            <input type="text" ng-model="form.name_company" class="form-control" disabled>
                            <input type="hidden" ng-model="form.id_company">

                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" ng-click="removeCompany()"
                                        ng-show="form.id_company != 0 && form.id_company != undefined">x
                                </button>
                            <button class="btn btn-default" type="button" ng-click="loadCompany()">...</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Service</label>
                        <input type="text" ng-model="form.department" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Fonction</label>
                        <input type="text" ng-model="form.job" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="well">
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" ng-model="form.email" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" ng-model="form.email_opt_out"> Rejet des mails
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" ng-model="form.mobile" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="text" ng-model="form.phone" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Autre téléphone</label>
                        <input type="text" ng-model="form.other_phone" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Assistant(e)</label>
                        <input type="text" ng-model="form.assistant" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Assistant(e) téléphone</label>
                        <input type="text" ng-model="form.assistant_phone" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Télécopie</label>
                        <input type="text" ng-model="form.fax" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Skype ID</label>
                        <input type="text" ng-model="form.skype_id" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Twitter</label>
                        <input type="text" ng-model="form.twitter" class="form-control">
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
                        <label>Adresse</label>
                        <input type="text" ng-model="form.address_1" class="form-control">
                        <input type="text" ng-model="form.address_2" class="form-control">
                        <input type="text" ng-model="form.address_3" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>État</label>
                        <input type="text" ng-model="form.state" class="form-control">
                    </div>
                </div>



                <div class="col-md-6">
                    <div class="form-group">
                        <label>Code postal</label>
                        <input type="text" ng-model="form.zipcode" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Ville</label>
                        <input type="text" ng-model="form.city" class="form-control">
                    </div>



                    <div class="form-group">
                        <label>Pays</label>
                        <div class="input-group">
                            <input type="text" ng-model="form.country_lang_name" class="form-control" disabled>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" ng-click="removeCountryLang()"
                                        ng-show="form.country_lang != '' && form.country_lang != undefined">x
                                </button>
                            <button class="btn btn-default" type="button" ng-click="loadCountryLang()">...</button>
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