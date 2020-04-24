<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mpengguna extends CI_Model{
    private $_table = "pengguna";

    public $id_produk;
    public $nama;
    public $harga;
    public $gambar = "default.jpg";
    public $deskripsi;

    public function rules(){
        return[
            ['field' => 'nama_pengguna',
            'label' => 'Nama Pengguna',
            'rules' => 'required'],

            ['field' => 'email',
            'label' => 'Username',
            'rules' => 'required'],

            ['field' => 'password',
            'label' => 'Password',
            'rules' => 'required']
        ];
    }

    //fungsi untuk mengambil semua data dari table produk($_table)
    public function getAll(){
        return $this->db->get($this->_table)->result();
    }

    //
    public function getById($id){
        return $this->db->get_where($this->_table, ["id_produk"=>$id])->row();
    }

    public function admin()
    {
        $query = "SELECT a.*, b.no_kelas, b.rombel, c.nama_jurusan, c.nama_singkat, e.nama_guru from pengguna a 
        left join kelas b on a.akses_data=b.kode_kelas
        left join jurusan c on b.kode_jurusan=c.kode_jurusan
        left join guru e on a.akses_data=e.kode_guru WHERE level='1'";

        $db_result = $this->db->query($query);
        $result_object = $db_result->result_array();
        return $result_object;
        //return $this->db->get_where($this->_table,["level"=>$level])->row();
    }

    public function guru()
    {
        $query = "SELECT a.*, b.no_kelas, b.rombel, c.nama_jurusan, c.nama_singkat, e.nama_guru from pengguna a 
        left join kelas b on a.akses_data=b.kode_kelas
        left join jurusan c on b.kode_jurusan=c.kode_jurusan
        left join guru e on a.akses_data=e.kode_guru WHERE level='2'";

        $db_result = $this->db->query($query);
        $result_object = $db_result->result_array();
        return $result_object;
    }

    public function siswa()
    {
        $query = "SELECT a.*, b.no_kelas, b.rombel, c.nama_jurusan, c.nama_singkat, e.nama_guru from pengguna a 
        left join kelas b on a.akses_data=b.kode_kelas
        left join jurusan c on b.kode_jurusan=c.kode_jurusan
        left join guru e on a.akses_data=e.kode_guru WHERE level='3'";

        $db_result = $this->db->query($query);
        $result_object = $db_result->result_array();
        return $result_object;
    }

    public function save(){
        $post = $this->input->post(); //membuat variabel post untuk menampung method $_POST
        $this->id_produk = uniqid(); //agar id menjadi acak
        $this->nama = $post["nama"];
        $this->harga = $post["harga"];
        $this->gambar = $this->_uploadImage();
        $this->deskripsi = $post["deskripsi"];
        return $this->db->insert($this->_table, $this);
    }

    public function update(){
        $post = $this->input->post();
        $this->id_produk = $post["id"];
        $this->nama = $post["nama"];
        $this->harga = $post["harga"];

        if (!empty($_FILES["gambar"]["nama"])) {
            $this->gambar = $this->_uploadImage();
        }else {
            $this->gambar = $post["old_image"];
        }

        $this->deskripsi = $post["deskripsi"];
        return $this->db->update($this->_table, $this, array('id_produk'=>$post['id']));
    }

    public function delete($id){
        return $this->db->delete($this->_table, array("id_produk"=> $id));
    }

    private function _uploadImage()
    {
        $config['upload_path'] = './upload/produk/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $this->id_produk;
        $config['overwrite'] = true;
        $config['max_size'] = 1024;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
        return $this->upload->data("file_name");
        }

        return "default.jpg";
    }

    
}

   

?>