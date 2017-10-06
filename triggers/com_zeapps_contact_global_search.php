<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class com_zeapps_contact_global_search extends ZeCtrl
{
    public function execute($data = array()){
        $this->load->model('Zeapps_contacts', 'contacts');
        $this->load->model('Zeapps_companies', 'companies');

        $return = array(
            "Contacts" => []
        );

        if($companies = $this->companies->searchFor($data)){
            $return['Contacts']["Entreprises"] = [];
            foreach($companies as $company){
                $return['Contacts']["Entreprises"][] = array(
                    'label' => $company->company_name,
                    'url' => "/ng/com_zeapps_contact/companies/".$company->id
                );
            }
        }

        if($contacts = $this->contacts->searchFor($data)){
            $return['Contacts']["Contacts"] = [];
            foreach($contacts as $contact){
                $return['Contacts']["Contacts"][] = array(
                    'label' => $contact->title_name . " " . $contact->first_name . " " . $contact->last_name . ($contact->name_company !== "" ? " (" . $contact->name_company .")" : ""),
                    'url' => "/ng/com_zeapps_contact/contacts/".$contact->id
                );
            }
        }

        return $return;
    }
}
