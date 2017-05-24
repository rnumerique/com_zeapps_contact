<?php
class Zeapps_country_lang extends ZeModel {
    public function get_select(){
        return $this->database()->select('zeapps_country_lang.name as label,
                                        zeapps_country_lang.id_country as value')
            ->table('zeapps_country_lang')
            ->result();
    }
}