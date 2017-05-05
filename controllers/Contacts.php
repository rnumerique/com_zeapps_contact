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











    public function getAll($id_company = null) {
        $this->load->model("Zeapps_contacts", "contacts");

        $where = [];

        if($id_company)
            $where['id_company'] = $id_company;
        $contacts = $this->contacts->all($where);

        if ($contacts == false) {
            echo json_encode(array());
        } else {
            echo json_encode($contacts);
        }

    }

    public function get($id) {
        $this->load->model("Zeapps_contacts", "contacts");
        echo json_encode($this->contacts->get($id));
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

        echo json_encode($id);
    }


    public function delete($id) {
        $this->load->model("Zeapps_contacts", "contacts");
        $this->contacts->delete($id);

        echo json_encode("OK");
    }

}
