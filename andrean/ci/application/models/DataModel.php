<?php
class DataModel extends CI_Model{
    public function getData(){
        $data = [
            'nama' => 'Frengki',
            'status' => 'gembel',
            'website' => 'http://frengki.com',
        ];
        return $data;
    }
}

?>