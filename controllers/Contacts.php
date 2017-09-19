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

        if(!$contacts = $this->contacts->limit($limit, $offset)->order_by('last_name, first_name')->all($filters)){
            $contacts = [];
        }
        $total = $this->contacts->count($filters);

        $ids = [];
        if($total < 500) {
            if ($rows = $this->contacts->get_ids($filters)) {
                foreach ($rows as $row) {
                    array_push($ids, $row->id);
                }
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
        $this->load->model('Zeapps_orders', 'orders', 'com_zeapps_crm');
        $this->load->model('Zeapps_invoices', 'invoices', 'com_zeapps_crm');

        if(!$account_families = $this->account_families->all()){
            $account_families = [];
        }

        if(!$topologies = $this->topologies->all()){
            $topologies = [];
        }

        if($contact = $this->contacts->get($id)){
            $contact->average_order = $this->orders->frequencyOf($id, 'contact');
            $contact->turnovers = $this->invoices->turnoverByYearsOf($id, 'contact');
        }
        else{
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

        if(!$contacts = $this->contacts->limit($limit, $offset)->order_by('last_name, first_name')->all($filters)){
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

    public function make_export(){
        $this->load->model("Zeapps_contacts", "contacts");

        $filters = [];

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        $total = $this->contacts->count($filters);

        $data = array();
        $data[] = array(
            "Civilité",
            "Nom",
            "Prénom",
            "Type de compte",
            "Topologie",
            "Compagnie",
            "Adresse 1",
            "Adresse 2",
            "Adresse 3",
            "Ville",
            "Code postal",
            "Etat",
            "Pays",
            "Email",
            "Telephone 1",
            "Telephone 2",
            "Mobile",
            "Fax",
            "Assistant",
            "Téléphone assistant",
            "Skype",
            "Twitter",
            "Site Web",
            "Date de naissance",
            "Code NAF",
            "Date de la derniere commande"
        );

        if($total > 0) {
            for ($i = 0; $i < $total; $i += 2500) {
                if ($contacts = $this->contacts->limit(2500, $i)->order_by('last_name, first_name')->all($filters)) {
                    foreach($contacts as &$contact) {
                        $data[] = array(
                            $contact->title_name,
                            $contact->last_name,
                            $contact->first_name,
                            $contact->name_account_family,
                            $contact->name_topology,
                            $contact->name_company,
                            $contact->address_1,
                            $contact->address_2,
                            $contact->address_3,
                            $contact->city,
                            $contact->zipcode,
                            $contact->state,
                            $contact->country_name,
                            $contact->email,
                            $contact->phone,
                            $contact->other_phone,
                            $contact->mobile,
                            $contact->fax,
                            $contact->assistant,
                            $contact->assistant_phone,
                            $contact->skype_id,
                            $contact->twitter,
                            $contact->website_url,
                            date('d/m/Y', $contact->date_of_birth),
                            $contact->code_naf_libelle,
                            date('d/m/Y', $contact->last_order)
                        );
                    }
                }
            }

            $writer = new XLSXWriter();

            $writer->writeSheet($data);

            recursive_mkdir(FCPATH . 'tmp/com_zeapps_contact/contacts/');
            $writer->writeToFile(FCPATH . 'tmp/com_zeapps_contact/contacts/contacts.xlsx');

            echo json_encode(true);
        }
        else {
            echo json_encode(false);
        }
    }

    public function get_export(){
        $file_url = FCPATH . 'tmp/com_zeapps_contact/contacts/contacts.xlsx';

        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
        readfile($file_url);
    }

}
