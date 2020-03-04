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

    public function getResultData($tipe)
    {
        if ($tipe == 'artikel') {
            return $this->db->get('artikel')->result_array();
        }
    }
    public function getSingleData($tipe, $key)
    {
        if ($tipe == 'artikel') {
            return $this->db->get_where('artikel',['kode_artikel' => $key])->row_array();
        }
    }

    public function insert($tabel, $arr)
    {
        $cek = $this->db->insert($tabel, $arr);
        return $cek;
    }
    public function update($tabel, $arr, $key, $id)
    {
        $cek = $this->db->update($tabel, $arr,[$key => $id]);
        return $cek;
    }
    public function delete($tabel, $key, $id)
    {
        $cek = $this->db->delete($tabel, [$key => $id]);
        return $cek;
    }
}

?>