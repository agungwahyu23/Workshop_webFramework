<?php
class DataModel extends CI_Model 
{
    //mengextends CI_Model
    public function getData () {
        $data = array (
            'nama' => 'frengki',
            'status' => 'Mahasiswa',
            'website'  => 'http://freng.ky'
        );
        return $data;
    }
}