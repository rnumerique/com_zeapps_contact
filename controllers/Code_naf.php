<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Code_naf extends ZeCtrl
{
    public function modal_code_naf()
    {
        $data = array() ;

        $this->load->view('code_naf/modalCode_naf', $data);
    }











    public function get($id) {
        $this->load->model("Zeapps_code_naf", "code_naf");
        echo json_encode($this->code_naf->get($id));
    }

    public function getAll() {
        $this->load->model("Zeapps_code_naf", "code_naf");
        $code_naf = $this->code_naf->all();

        if ($code_naf == false) {
            echo json_encode(array());
        } else {
            echo json_encode($code_naf);
        }

    }

    public function modal($limit = 15, $offset = 0)
    {
        $this->load->model("Zeapps_code_naf", "code_naf");

        $filters = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        $total = $this->code_naf->count($filters);

        if(!$code_naf = $this->code_naf->limit($limit, $offset)->all($filters)){
            $code_naf = [];
        }

        echo json_encode(array("data" => $code_naf, "total" => $total));
    }


}
