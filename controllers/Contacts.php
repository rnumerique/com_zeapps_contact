<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends ZeCtrl
{
    public function search()
    {
        $this->load->view('contacts/search');
    }

    public function list_partial()
    {
        $this->load->view('contacts/list_partial');
    }

    public function view()
    {
        $this->load->view('contacts/view');
    }

    public function form_modal()
    {
        $this->load->view('contacts/form_modal');
    }

    public function modal_contact()
    {
        $this->load->view('contacts/modalContact');
    }









    public function context() {
        $this->load->model('Zeapps_account_families', 'account_families');
        $this->load->model('Zeapps_topologies', 'topologies');

        if(!$account_families = $this->account_families->all()){
            $account_families = [];
        }

        if(!$topologies = $this->topologies->all()){
            $topologies = [];
        }

        echo json_encode(array('account_families' => $account_families, 'topologies' => $topologies));
    }


    public function getAll($id_company = "0", $limit = 15, $offset = 0, $context = false) {
        $this->load->model("Zeapps_contacts", "contacts");

        $filters = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        if($id_company !== "0")
            $filters['id_company'] = $id_company;

        if(!$contacts = $this->contacts->limit($limit, $offset)->all($filters)){
            $contacts = [];
        }
        $total = $this->contacts->count($filters);

        $ids = [];
        if($rows = $this->contacts->all($filters)){
            foreach($rows as $row){
                array_push($ids, $row->id);
            }
        }

        if($context){
            $this->load->model('Zeapps_account_families', 'account_families');
            $this->load->model('Zeapps_topologies', 'topologies');

            if(!$account_families = $this->account_families->all()){
                $account_families = [];
            }

            if(!$topologies = $this->topologies->all()){
                $topologies = [];
            }
        }
        else{
            $account_families = [];
            $topologies = [];
        }

        echo json_encode(array(
            'account_families' => $account_families,
            'topologies' => $topologies,
            'contacts' => $contacts,
            "total" => $total,
            'ids' => $ids
        ));
    }

    public function get($id) {
        $this->load->model("Zeapps_contacts", "contacts");
        $this->load->model('Zeapps_account_families', 'account_families');
        $this->load->model('Zeapps_topologies', 'topologies');

        if(!$account_families = $this->account_families->all()){
            $account_families = [];
        }

        if(!$topologies = $this->topologies->all()){
            $topologies = [];
        }

        if(!$contact = $this->contacts->get($id)){
            $contact = [];
        }

        echo json_encode(array('account_families' => $account_families, 'topologies' => $topologies, 'contact' => $contact));
    }

    public function modal($id_company = '0', $limit = 15, $offset = 0) {
        $this->load->model("Zeapps_contacts", "contacts");

        $filters = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        if($id_company !== "0")
            $filters['id_company'] = $id_company;

        $total = $this->contacts->count($filters);

        if(!$contacts = $this->contacts->limit($limit, $offset)->all($filters)){
            $contacts = [];
        }

        echo json_encode(array("data" => $contacts, "total" => $total));
    }

    public function save() {
        $this->load->model("Zeapps_contacts", "contacts");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (isset($data["id"])) {
            $this->contacts->update($data, $data["id"]);
            $id = $data['id'];
        } else {
            $id = $this->contacts->insert($data);
        }

        echo $id;
    }


    public function delete($id) {
        $this->load->model("Zeapps_contacts", "contacts");
        $this->contacts->delete($id);

        echo json_encode("OK");
    }

}
