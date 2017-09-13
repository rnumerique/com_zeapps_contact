<?php
class Zeapps_companies extends ZeModel {
    public function get_ids($where = array()){

        $where['deleted_at'] = null;

        return $this->database()->select('id')
            ->where($where)
            ->table('zeapps_companies')
            ->result();
    }
}