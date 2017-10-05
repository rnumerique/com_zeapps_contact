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

        if(!$companies = $this->companies->limit($limit, $offset)->order_by('company_name')->all($filters)){
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

        if(!$companies = $this->companies->limit($limit, $offset)->order_by('company_name')->all($filters)){
            $companies = [];
        }

        echo json_encode(array("data" => $companies, "total" => $total));
    }

    public function get($id) {
        $this->load->model("Zeapps_companies", "companies");
        $this->load->model("Zeapps_contacts", "contacts");
        $this->load->model('Zeapps_account_families', 'account_families');
        $this->load->model('Zeapps_topologies', 'topologies');
        $this->load->model('Zeapps_orders', 'orders', 'com_zeapps_crm');
        $this->load->model('Zeapps_invoices', 'invoices', 'com_zeapps_crm');

        if(!$account_families = $this->account_families->all()){
            $account_families = [];
        }

        if(!$topologies = $this->topologies->all()){
            $topologies = [];
        }

        if(!$contacts = $this->contacts->all(array('id_company' => $id))){
            $contacts = [];
        }

        if($company = $this->companies->get($id)){
            $company->average_order = $this->orders->frequencyOf($id, 'company');
            $company->turnovers = $this->invoices->turnoverByYearsOf($id, 'company');
        }
        else{
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

        echo json_encode($this->companies->delete($id));
    }

    public function make_export(){
        $this->load->model("Zeapps_companies", "companies");

        $filters = [];

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        if($companies = $this->companies->order_by('company_name')->all($filters)){

            $objPHPExcel = new PHPExcel();

            $objPHPExcel->getActiveSheet()->setCellValue('A1', "Raison Sociale");
            $objPHPExcel->getActiveSheet()->setCellValue('B1', "Compagnie mère");
            $objPHPExcel->getActiveSheet()->setCellValue('C1', "Type de compte");
            $objPHPExcel->getActiveSheet()->setCellValue('D1', "Topologie");
            $objPHPExcel->getActiveSheet()->setCellValue('E1', "Domaine d'activité");
            $objPHPExcel->getActiveSheet()->setCellValue('F1', "Chiffre d'affaires");
            $objPHPExcel->getActiveSheet()->setCellValue('G1', "Adresse de facturation 1");
            $objPHPExcel->getActiveSheet()->setCellValue('H1', "Adresse 2");
            $objPHPExcel->getActiveSheet()->setCellValue('I1', "Adresse 3");
            $objPHPExcel->getActiveSheet()->setCellValue('J1', "Ville");
            $objPHPExcel->getActiveSheet()->setCellValue('K1', "Code postal");
            $objPHPExcel->getActiveSheet()->setCellValue('L1', "Etat");
            $objPHPExcel->getActiveSheet()->setCellValue('M1', "Pays");
            $objPHPExcel->getActiveSheet()->setCellValue('N1', "Adresse de livraison 1");
            $objPHPExcel->getActiveSheet()->setCellValue('O1', "Adresse 2");
            $objPHPExcel->getActiveSheet()->setCellValue('P1', "Adresse 3");
            $objPHPExcel->getActiveSheet()->setCellValue('Q1', "Ville");
            $objPHPExcel->getActiveSheet()->setCellValue('R1', "Code postal");
            $objPHPExcel->getActiveSheet()->setCellValue('S1', "Etat");
            $objPHPExcel->getActiveSheet()->setCellValue('T1', "Pays");
            $objPHPExcel->getActiveSheet()->setCellValue('U1', "Email");
            $objPHPExcel->getActiveSheet()->setCellValue('V1', "Telephone");
            $objPHPExcel->getActiveSheet()->setCellValue('W1', "Fax");
            $objPHPExcel->getActiveSheet()->setCellValue('X1', "SiteWeb");
            $objPHPExcel->getActiveSheet()->setCellValue('Y1', "Code NAF");
            $objPHPExcel->getActiveSheet()->setCellValue('Z1', "SIRET");

            foreach ($companies as $key => $company) {
                $i = $key + 2;
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $company->company_name);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $company->name_parent_company);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $company->name_account_family);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $company->name_topology);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $company->name_activity_area);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $company->turnover);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $company->billing_address_1);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $company->billing_address_2);
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $company->billing_address_3);
                $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $company->billing_city);
                $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $company->billing_zipcode);
                $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $company->billing_state);
                $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $company->billing_country_name);
                $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, $company->delivery_address_1);
                $objPHPExcel->getActiveSheet()->setCellValue('O' . $i, $company->delivery_address_2);
                $objPHPExcel->getActiveSheet()->setCellValue('P' . $i, $company->delivery_address_3);
                $objPHPExcel->getActiveSheet()->setCellValue('Q' . $i, $company->delivery_city);
                $objPHPExcel->getActiveSheet()->setCellValue('R' . $i, $company->delivery_zipcode);
                $objPHPExcel->getActiveSheet()->setCellValue('S' . $i, $company->delivery_state);
                $objPHPExcel->getActiveSheet()->setCellValue('T' . $i, $company->delivery_country_name);
                $objPHPExcel->getActiveSheet()->setCellValue('U' . $i, $company->email);
                $objPHPExcel->getActiveSheet()->setCellValue('V' . $i, $company->phone);
                $objPHPExcel->getActiveSheet()->setCellValue('W' . $i, $company->fax);
                $objPHPExcel->getActiveSheet()->setCellValue('X' . $i, $company->website_url);
                $objPHPExcel->getActiveSheet()->setCellValue('Y' . $i, $company->code_naf_libelle);
                $objPHPExcel->getActiveSheet()->setCellValue('Z' . $i, $company->company_number);
            }

            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

            recursive_mkdir(FCPATH . 'tmp/com_zeapps_contact/companies/');

            $objWriter->save(FCPATH . 'tmp/com_zeapps_contact/companies/companies.xlsx');

            echo json_encode(true);
        }
        else {
            echo json_encode(false);
        }
    }

    public function get_export(){
        $file_url = FCPATH . 'tmp/com_zeapps_contact/companies/companies.xlsx';

        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
        readfile($file_url);
    }
}
