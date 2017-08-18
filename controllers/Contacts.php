<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends ZeCtrl
{
    public function search()
    {
        $data = array() ;

        $this->load->view('contacts/search', $data);
    }

    public function view()
    {
        $data = array() ;

        $this->load->view('contacts/view', $data);
    }

    public function form()
    {
        $data = array() ;

        $this->load->view('contacts/form', $data);
    }

    public function modal_contact()
    {
        $data = array() ;

        $this->load->view('contacts/modalContact', $data);
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


    public function getAll($id_company = null) {
        $this->load->model("Zeapps_contacts", "contacts");
        $this->load->model('Zeapps_account_families', 'account_families');
        $this->load->model('Zeapps_topologies', 'topologies');

        $where = [];

        if($id_company)
            $where['id_company'] = $id_company;

        if(!$account_families = $this->account_families->all()){
            $account_families = [];
        }

        if(!$topologies = $this->topologies->all()){
            $topologies = [];
        }

        if(!$contacts = $this->contacts->all($where)){
            $contacts = [];
        }

        echo json_encode(array('account_families' => $account_families, 'topologies' => $topologies, 'contacts' => $contacts));
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

    public function modal($limit = 15, $offset = 0) {
        $this->load->model("Zeapps_contacts", "contacts");

        $total = $this->contacts->count();

        if(!$contacts = $this->contacts->limit($limit, $offset)->all()){
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
