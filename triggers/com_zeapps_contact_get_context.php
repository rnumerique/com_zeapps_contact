<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class com_zeapps_contact_get_context extends ZeCtrl
{
    public function execute($data = array()){
        $this->load->model('Zeapps_account_families', 'account_families');
        $this->load->model('Zeapps_topologies', 'topologies');

        $return = [];

        if($return['account_families'] = $this->account_families->all()){
            foreach($return['account_families'] as $account_family){
                $account_family->sort = intval($account_family->sort);
            }
        }
        else{
            $return['account_families'] = [];
        }

        if($return['topologies'] = $this->account_families->all()){
            foreach($return['topologies'] as $topology){
                $topology->sort = intval($topology->sort);
            }
        }
        else{
            $return['topologies'] = [];
        }

        return $return;
    }
}
