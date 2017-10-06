<?php
class Zeapps_companies extends ZeModel {
    public function get_ids($where = array()){

        $where['deleted_at'] = null;

        return $this->database()->select('id')
            ->where($where)
            ->order_by('company_name')
            ->table('zeapps_companies')
            ->result();
    }

    public function searchFor($terms = array()){
        $where = [];

        foreach($terms as $term){
            $where['company_name'] = $term;
            $where['billing_country_name'] = $term;
        }

        return $this->database()->select('*')
            ->where(array("deleted_at" => null))
            ->where_like_or($where)
            ->group_by('id')
            ->limit(10, 0)
            ->table('zeapps_companies')
            ->result();
    }
}