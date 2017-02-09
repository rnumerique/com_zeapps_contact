<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country_lang extends ZeCtrl
{
    public function modal_country_lang()
    {
        $data = array() ;

        $this->load->view('country_lang/modalCountry_lang', $data);
    }


    public function getAll() {
        $this->load->model("Zeapps_country_lang", "country_lang");
        $country_lang = $this->country_lang->all();

        if ($country_lang == false) {
            echo json_encode(array());
        } else {
            echo json_encode($country_lang);
        }

    }

    public function get($id) {
        $this->load->model("Zeapps_country_lang", "country_lang");
        echo json_encode($this->country_lang->get($id));
    }



}
