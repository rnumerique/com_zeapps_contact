<?php
class Zeapps_contacts extends ZeModel {
    public function getEmailsByMonth($where = array(), $year = 0, $month = 0){
        $query = "SELECT COUNT(*) as total FROM zeapps_contacts WHERE YEAR(created_at) = ".$year." AND MONTH(created_at) = ".$month." AND email != '' AND opt_out = 0 AND deleted_at IS NULL";

        if(isset($where['country_id'])){
            $query .= " AND country_id IN (".implode(',', $where['country_id']).")";
        }

        return $this->database()->customQuery($query)->result();
    }

    public function get_ids($where = array()){

        $where['deleted_at'] = null;

        return $this->database()->select('id')
            ->where($where)
            ->order_by('last_name, first_name')
            ->table('zeapps_contacts')
            ->result();
    }
}