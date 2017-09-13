<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Companies extends ZeCtrl
{
    public function search()
    {
        $this->load->view('companies/search');
    }

    public function view()
    {
        $this->load->view('companies/view');
    }

    public function form_modal()
    {
        $this->load->view('companies/form_modal');
    }

    public function summary_partial()
    {
        $this->load->view('companies/summary_partial');
    }

    public function modal_company()
    {
        $this->load->view('companies/modalCompany');
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

    public function getAll($limit = 15, $offset = 0, $context = false) {
        $this->load->model("Zeapps_companies", "companies");

        $filters = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        if(!$companies = $this->companies->limit($limit, $offset)->all($filters)){
            $companies = [];
        }
        $total = $this->companies->count($filters);

        $ids = [];
        if($total < 500) {
            if ($rows = $this->companies->get_ids($filters)) {
                foreach ($rows as $row) {
                    array_push($ids, $row->id);
                }
            }
        }

        if($context) {
            $this->load->model('Zeapps_account_families', 'account_families');
            $this->load->model('Zeapps_topologies', 'topologies');

            if (!$account_families = $this->account_families->all()) {
                $account_families = [];
            }

            if (!$topologies = $this->topologies->all()) {
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
            'companies' => $companies,
            'total' => $total,
            'ids' => $ids
        ));
    }

    public function modal($limit = 15, $offset = 0) {
        $this->load->model("Zeapps_companies", "companies");

        $filters = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        $total = $this->companies->count($filters);

        if(!$companies = $this->companies->limit($limit, $offset)->all($filters)){
            $companies = [];
        }

        echo json_encode(array("data" => $companies, "total" => $total));
    }

    public function get($id) {
        $this->load->model("Zeapps_companies", "companies");
        $this->load->model("Zeapps_contacts", "contacts");
        $this->load->model('Zeapps_account_families', 'account_families');
        $this->load->model('Zeapps_topologies', 'topologies');

        if(!$account_families = $this->account_families->all()){
            $account_families = [];
        }

        if(!$topologies = $this->topologies->all()){
            $topologies = [];
        }

        if(!$contacts = $this->contacts->all(array('id_company' => $id))){
            $contacts = [];
        }

        if(!$company = $this->companies->get($id)){
            $company = [];
        }

        echo json_encode(array(
            'account_families' => $account_families,
            'topologies' => $topologies,
            'contacts' => $contacts,
            'company' => $company
        ));
    }

    public function save() {
        $this->load->model("Zeapps_companies", "companies");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->companies->update($data, $data["id"]);
            $id = $data['id'];
        } else {
            $id = $this->companies->insert($data);
        }

        echo $id;
    }


    public function delete($id) {
        $this->load->model("Zeapps_companies", "companies");
        $this->companies->delete($id);

        echo json_encode("OK");
    }

}
