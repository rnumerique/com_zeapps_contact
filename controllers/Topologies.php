<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topologies extends ZeCtrl
{
    public function config()
    {
        $this->load->view('topologies/config');
    }

    public function form_modal(){
        $this->load->view('topologies/form_modal');
    }

    public function get_all() {
        $this->load->model("Zeapps_topologies", "topologies");
        $topologies = $this->topologies->all();

        if ($topologies == false) {
            echo json_encode(array());
        } else {
            echo json_encode($topologies);
        }
    }

    public function save() {
        $this->load->model("Zeapps_topologies", "topologies");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->topologies->update($data, $data["id"]);
            $id = $data['id'];
        } else {
            $id = $this->topologies->insert($data);
        }

        echo $id;
    }

    public function save_all(){
        $this->load->model("Zeapps_topologies", "topologies");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if($data && is_array($data)){
            foreach($data as $topologies){
                $this->topologies->update($topologies, $topologies['id']);
            }
            echo json_encode(true);
        }
        else{
            echo json_encode(false);
        }
    }


    public function delete($id) {
        $this->load->model("Zeapps_topologies", "topologies");

        echo json_encode($this->topologies->delete($id));
    }

}
