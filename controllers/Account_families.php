<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_families extends ZeCtrl
{
    public function config()
    {
        $this->load->view('account_families/config');
    }

    public function form_modal(){
        $this->load->view('account_families/form_modal');
    }

    public function get_all() {
        $this->load->model("Zeapps_account_families", "account_families");
        $account_families = $this->account_families->all();

        if ($account_families == false) {
            echo json_encode(array());
        } else {
            echo json_encode($account_families);
        }
    }

    public function save() {
        $this->load->model("Zeapps_account_families", "account_families");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->account_families->update($data, $data["id"]);
            $id = $data['id'];
        } else {
            $id = $this->account_families->insert($data);
        }

        echo $id;
    }

    public function save_all(){
        $this->load->model("Zeapps_account_families", "account_families");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if($data && is_array($data)){
            foreach($data as $account_families){
                $this->account_families->update($account_families, $account_families['id']);
            }
            echo json_encode('OK');
        }
        else{
            echo json_encode('false');
        }
    }


    public function delete($id) {
        $this->load->model("Zeapps_account_families", "account_families");
        $this->account_families->delete($id);

        echo json_encode("OK");
    }

}
