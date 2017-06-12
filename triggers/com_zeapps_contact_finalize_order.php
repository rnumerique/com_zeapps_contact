<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class com_zeapps_contact_finalize_order extends ZeCtrl
{
    public function execute($data = array()){
        $this->load->model('Zeapps_orders', 'orders', 'com_zeapps_crm');
        $this->load->model('Zeapps_order_lines', 'order_lines', 'com_zeapps_crm');
        $this->load->model('Zeapps_product_products', 'products', 'com_zeapps_crm');
        $this->load->model('Zeapps_product_categories', 'categories', 'com_zeapps_crm');
        $this->load->model('Zeapps_contacts', 'contacts');
        $this->load->model('Zeapps_contact_order_categories', 'contact_order_categories');

        $order = $this->orders->get($data['id']);

        if($order && $order->id_contact != 0){
            $now = date('Y-m-d H:i:s');
            $this->contacts->update(array('last_order' => $now), $order->id_contact);

            $contact = $this->contacts->get($order->id_contact);

            if($lines = $this->order_lines->all(array('id_order' => $data['id'], 'type' => 'product'))){
                foreach($lines as &$line){
                    if($product = $this->products->get($line->id_product)){
                        if($category = $this->categories->get($product->id_cat)){
                            $data = [
                                'id_contact' => $contact->id,
                                'name_contact' => $contact->first_name . ' ' . $contact->last_name,
                                'id_category' => $category->id,
                                'label_category' => $category->name
                            ];
                            $this->contact_order_categories->insert($data);
                        }
                    }
                }
            }
        }
    }
}
