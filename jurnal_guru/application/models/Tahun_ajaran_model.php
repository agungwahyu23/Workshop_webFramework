<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tahun_ajaran_model extends CI_Model{
    private $_table = "tahun_ajaran";
    public $kode_tahun;
    public $tahun;
    public $aktif;
    public $status;
    public $create_at = date("Y-m-d H:i:s");
    public $create_by;

    public function rules()
    {
        return[
            ['field'=>'tahun'
            'label'=>'Tahun'
            'rules'=>'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->$_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->$_table, ["kode_tahun"=>$id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->kode_tahun = uniqid();
        $this->tahun = $post["tahun"];
        $this->aktif = $post["aktif"];
        $this->status = $post["status"];
        $this->create_at = date("Y-m-d H:i:s");
        $this->create_by = $post["create_by"];
        return $this->db->insert($this->$_table, $this);
    }

    public function update()
    {
        # code...
    }
}

?>