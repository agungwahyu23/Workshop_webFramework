<?php
class ArtikelModel extends CI_Model {
    public function get() {
    $this->load->database();
    return $this->db->get("artikel")->result();
}

public function detail ($id) {
    $this->load->database();
    $this->db->where('id', $id);
    return $this->db->get("artikel")->result();
}

public function tambah ($data = array()) {
    $this->load->database();
    return $this->db->insert("artikel", $data);
}

public function ubah($data = array(), $id) {
    $this->load->database();
    $this->db->where('id', $id);
    return $this->db->update("artikel", $data);
}

public function hapus($id) {
    $this->load->database();
    $this->db->where('id', $id);
    return $this->db->delete("artikel");
}
}
?>
