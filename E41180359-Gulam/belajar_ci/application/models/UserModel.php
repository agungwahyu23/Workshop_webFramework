<?php
class UserModel extends CI_Model {
    public function get ($data = array(), $id) {
        $this->load->database(); //memanggil database
        this->db->where('id', $id);
        //select data, apabila semua data tulis *
        $this->db->insert("pegawai", $data);
        //diurutkan berdasarkan descending
        // $this->db->order_by("id", "DESC");
        //memberikan basis data yang diambil
        // $this->db->limit(2,0);
        //memberikan basis data yang data yang diambil berdasarkan group
        // $this->db->group_by("alamat");
         //memberikan basis data yang data yang diambil berdasarkan where
        // $this->db->where("id",2);
//ambil data tabel pegawai
// $query = $this->db->get("pegawai");
// $query = $this->db->query("select* from pegawai");
return $this->db->update('pegawai', $data); // untuk menampilkan hasil
    // }
    //  public function get ($data) {
    //   $this->load->database();
    //   $this->db->insert("pegawai", $data);
    }
}
?>