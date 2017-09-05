<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">
    Topologies
</div>

<div id="content">
    <div class="row">
        <div class="col-md-12">
            <ze-btn fa="plus" color="success" hint="Topologie" always-on="true"
                    ze-modalform="add"
                    data-template="templateForm"
                    data-title="Ajouter une nouvelle topologie"></ze-btn>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form>
                <table class="table table-responsive table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>
                            Libellé
                        </th>
                        <th>
                            Ordre
                        </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="topology in $root.topologies">
                        <td>
                            {{topology.label}}
                        </td>
                        <td>
                            {{topology.sort}}
                        </td>
                        <td class="text-right">
                            <ze-btn fa="pencil" color="info" hint="Editer" direction="left"
                                    ze-modalform="edit"
                                    data-edit="topology"
                                    data-template="templateForm"
                                    data-title="Modifier la topologie"></ze-btn>
                            <ze-btn fa="trash" color="danger" hint="Supprimer" direction="left" ng-click="delete(topology)" ze-confirmation></ze-btn>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>