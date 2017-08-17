<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Companies extends ZeCtrl
{
    public function search()
    {
        $data = array() ;

        $this->load->view('companies/search', $data);
    }

    public function view()
    {
        $data = array() ;

        $this->load->view('companies/view', $data);
    }



        public function form()
    {
        $data = array() ;

        $this->load->view('companies/form', $data);
    }

    public function modal_company()
    {
        $data = array() ;

        $this->load->view('companies/modalCompany', $data);
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

    public function getAll() {
        $this->load->model("Zeapps_companies", "companies");
        $this->load->model('Zeapps_account_families', 'account_families');
        $this->load->model('Zeapps_topologies', 'topologies');

        if(!$account_families = $this->account_families->all()){
            $account_families = [];
        }

        if(!$topologies = $this->topologies->all()){
            $topologies = [];
        }

        if(!$companies = $this->companies->all()){
            $companies = [];
        }

        echo json_encode(array('account_families' => $account_families, 'topologies' => $topologies, 'companies' => $companies));
    }

    public function modal($limit = 15, $offset = 0) {
        $this->load->model("Zeapps_companies", "companies");

        $total = $this->companies->count();

        if(!$companies = $this->companies->limit($limit, $offset)->all()){
            $companies = [];
        }

        echo json_encode(array("data" => $companies, "total" => $total));
    }

    public function get($id) {
        $this->load->model("Zeapps_companies", "companies");
        $this->load->model('Zeapps_account_families', 'account_families');
        $this->load->model('Zeapps_topologies', 'topologies');

        if(!$account_families = $this->account_families->all()){
            $account_families = [];
        }

        if(!$topologies = $this->topologies->all()){
            $topologies = [];
        }

        if(!$company = $this->companies->get($id)){
            $company = [];
        }

        echo json_encode(array('account_families' => $account_families, 'topologies' => $topologies, 'company' => $company));
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
        } else {
            $this->companies->insert($data);
        }

        echo json_encode("OK");
    }


    public function delete($id) {
        $this->load->model("Zeapps_companies", "companies");
        $this->companies->delete($id);

        echo json_encode("OK");
    }

}
