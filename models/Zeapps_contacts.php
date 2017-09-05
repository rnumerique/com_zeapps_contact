<?php
class Zeapps_contacts extends ZeModel {
    public function getEmailsByMonth($year = 0, $month = 0){
        $query = "SELECT * FROM zeapps_contacts WHERE YEAR(created_at) = ".$year." AND MONTH(created_at) = ".$month." AND email != '' AND opt_out = 0 AND deleted_at IS NULL";

        return $this->database()->customQuery($query)->result();
    }
}