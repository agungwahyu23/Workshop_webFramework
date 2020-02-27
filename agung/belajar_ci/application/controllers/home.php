<?php
class Home extends CI_Controller{
    public function index(){
    $this->load->library("session");
    $this->session->set_userdata("nama", "Polije");

    echo 'Nama anda : ' . $this->session->userdata("nama");
    echo '<br>Session di hapus<br>';

    $this->session->unset_userdata("nama");
    echo 'Nama anda : ' . $this->session->userdata("nama");

    // $error = "";
    // $data = "";

    // if ($this->input->method()=="post") {
    //     $config ['upload_path'] = './gambar/';
    //     $config ['allowed_types'] = 'gif|jpg|png';
    //     $config ['max_size'] = 100;
    //     $config ['max_width'] = 1024;
    //     $config ['max_heigh'] = 768;

    //     $this->load->library('upload', $config);

    //     if (!$this->upload->do_upload('gambar')) {
    //         $error = $this->upload->display_errors();
    //     }else {
    //         $data = $this->upload->data();
    //     }
        
    // }
    // $this->load->view("HomeView", array(
    //     'error' => $error,
    //     'data' => $data
    // ));

    // if ($this->input->method()=="post") {
    //     echo "nama : " . $this->input->post("nama"). "<br>";
    //     echo "email : " . $this->input->post("email");
    // }
    // $this->load->view("Homeview");

    // $this->load->helper("belajar");
    // tampilkanTebal("Polije");
    // tampilkanMiring("Jurusan Teknologi Informasi");
    // tampilkanBergaris("2020 <br>");

    // $this->load->helper("form");
    // echo form_open('/');
    // echo form_label('Nama : ') . '<br>';
    // echo form_input('nama : ') . '<br>';
    // echo form_label('Alamat : ') . '<br>';
    // echo form_textarea('alamat : ') . '<br>';
    // echo form_submit('submit', 'Kirim Data') . '<br>';
    // echo form_close();

    // $this->load->helper("url");
    // echo site_url() . '<br>';
    // echo base_url() . '<br>';
    // echo current_url() . '<br>';
    // echo anchor('http://google.com') . '<br>';
    // echo anchor('http://polije.ac.id', 'polije.ac.id') . '<br>';

        // $this->load->helper("number");
        // echo 'Ukuran GB : ' . byte_format(45122244422). '<br>';
        // echo 'Ukuran MB : ' . byte_format(52245023). '<br>';
        // echo 'Ukuran KB : ' . byte_format(145023). '<br>';

    // $this->load->helper("html");
    // echo heading ('Selamat Datang!', 1);
    // echo ul (array(
    //     'kesatu',
    //     'kedua',
    //     'ketiga'
    // ));
    // echo ol (array(
    //     'kesatu',
    //     'kedua',
    //     'ketiga'
    // ));

        // $this->load->model("DataModel");
        // $dataArr = $this->DataModel->getData();
        // // echo "nama : " . $dataArr ["nama"] . '<br>';
        // // echo "status : " . $dataArr ["status"] . '<br>';
        // // echo "website : " . $dataArr ["website"] . '<br>';
        // $this->load->view("HomeView", array("data" => $dataArr));
    }
}
?>